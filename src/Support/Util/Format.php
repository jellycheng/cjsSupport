<?php namespace CjsSupport\Util;

class Format
{

    protected $_data = array();

    protected $_from_type = null;

    
    public function __construct($data = null, $from_type = null)
    {
        if ($from_type !== null) {
            if (method_exists($this, '_from_' . $from_type)) {
                $data = call_user_func(array($this, '_from_' . $from_type), $data);
            } else {
                throw new \Exception('Format class does not support conversion from "' . $from_type . '".');
            }
        }
        $this->_data = $data;
    }

    /**
     * echo \CjsSupport\Util\Format::factory(array('foo' => 'bar'))->toJson();
     *
     * @param   mixed  general date to be converted
     * @param   string  data format the file was provided in
     * @return  Factory
     */
    public static function factory($data, $from_type = null)
    {
        return new static($data, $from_type);
    }

    public function toArray($data = null)
    {
        if ($data === null && !func_num_args()) {
            $data = $this->_data;
        }
        $array = array();
        foreach ((array)$data as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $array[$key] = $this->toArray($value);
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }

   
    public function toXML($data = null, $structure = null, $basenode = 'result')
    {
        if ($data === null and !func_num_args()) {
            $data = $this->_data;
        }
        
        if (ini_get('zend.ze1_compatibility_mode') == 1) {
            ini_set('zend.ze1_compatibility_mode', 0);
        }
        if ($structure === null) {
            $structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
        }
        if (!is_array($data) AND !is_object($data)) {
            $data = (array)$data;
        }
        foreach ($data as $key => $value) {
            //change false/true to 0/1
            if (is_bool($value)) {
                $value = (int)$value;
            }
            // no numeric keys in our xml please!
            if (is_numeric($key)) {
                // todo
                $key = 'item';
            }
            // replace anything not alpha numeric
            //$key = preg_replace('/[^a-z_\-0-9]/i', '', $key);
            // if there is another array found recursively call this function
            if (is_array($value) or is_object($value)) {
                $node = $structure->addChild($key);
                // recursive call.
                $this->toXML($value, $node, $key);
            } else {
                // add single node.
                $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, "UTF-8");
                $structure->addChild($key, $value);
            }
        }
        return $structure->asXML();
    }

    public function toCSV()
    {
        $data = $this->_data;
        if (isset($data[0]) && is_array($data[0])) {
            $headings = array_keys($data[0]);
        }  else {
            $headings = array_keys($data);
            $data = array($data);
        }
        $output = '"' . implode('","', $headings) . '"' . PHP_EOL;
        foreach ($data as &$row) {
            $row = str_replace('"', '""', $row); // Escape dbl quotes per RFC 4180
            $output .= '"' . implode('","', $row) . '"' . PHP_EOL;
        }
        return $output;
    }

    public function toJson($options=null)
    {
        if(is_null($options)) {
            $options = 0;
            if (defined('JSON_UNESCAPED_SLASHES')) {
                $options |= JSON_UNESCAPED_SLASHES;
            }
            if (defined('JSON_UNESCAPED_UNICODE')) {
                $options |= JSON_UNESCAPED_UNICODE;
            }
        }
        return \json_encode($this->_data);
    }

    public function toSerialized()
    {
        return serialize($this->_data);
    }

    public function toPHP()
    {
        return var_export($this->_data, true);
    }

    protected function _from_xml($string)
    {
        return $string ? (array)simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA) : array();
    }

    protected function _from_csv($string)
    {
        $data = array();
        $rows = explode("\n", trim($string));
        $headings = explode(',', array_shift($rows));
        foreach ($rows as $row) {
            $data_fields = explode('","', trim(substr($row, 1, -1)));
            if (count($data_fields) == count($headings)) {
                $data[] = array_combine($headings, $data_fields);
            }
        }
        return $data;
    }

    private function _from_json($string)
    {
        return json_decode(trim($string), true);
    }

    private function _from_serialize($string)
    {
        return unserialize(trim($string));
    }

}
