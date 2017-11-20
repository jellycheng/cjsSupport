<?php
namespace CjsSupport\DataManage;

/**
* 
*/
abstract class Data 
{
	protected $data = []; //key=>value 如 0=>'123', 'user'=>'a123', '100'

	protected function __construct()
	{
		
	}

	public static function getInstance() {
		static $instance;
		if(!$instance) {
			$instance = new static;
		}

		return $instance;
	}


	public function set($key, $value = null){

		if(is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
        	if (0 == strlen($key)) {//追加
        		$this->data[] = $value;
        	} else {
        		$keyPath = explode('.', $key);
        		$curV = &$this->data;
        		while (count($keyPath) > 1) {
		            $k = array_shift($keyPath);
		            if (!isset($curV[$k]) || ! is_array($curV[$k])) {
		                $curV[$k] = [];
		            }
		            $curV = &$curV[$k];
		        }
		        $curV[array_shift($keyPath)] = $value;
        	}
           
        }

        return $this;
	}

	/**
	 * 删除key 如a.b.c  ['user', 'nickname', 'a.b.c']
	 */
	public function remove($keys) {
		$original = &$this->data;
        $keys = (array) $keys;
        if (count($keys) === 0) {
            return $this;
        }

        foreach ($keys as $key) {
            if (array_key_exists($key, $original)) {
                unset($this->data[$key]);
                continue;
            }

            $parts = explode('.', $key);
            $array = &$original;
            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);
        }
        return $this;

	}

	/**
     * 清空数据
     * 
     */
    public function clearData() {
        $this->data = [];
        return $this;
    }

	public function get($key, $default = null){
		$currentV = $this->data;
		if (is_null($key)) return $currentV;
		
        $keyPath = explode('.', $key);
        foreach ($keyPath as $segment)
	    {// a.b.c
	        if ( ! is_array($currentV) || ! array_key_exists($segment, $currentV))
	        {   //不存在的key则返回默认值
	            return $default instanceof \Closure ? $default() : $default;
	        }

	        $currentV = $currentV[$segment];
	    }
	    return $currentV;
	}


	public function has($key) {
		$currentV = $this->data;
        $keyPath = explode('.', $key);
        for ( $i = 0; $i < count($keyPath); $i++ ) {
            $currentKey = $keyPath[$i];
            if (!is_array($currentV) || !array_key_exists($currentKey, $currentV) ) {
                return false;
            }
            $currentV = $currentV[$currentKey];
        }
        return true;

	}


	public function getData() {
		return $this->data;
	}


}