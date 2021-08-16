<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2021/8/14
 * Time: 15:09
 */

namespace CjsSupport\Consul;


class Client
{
    protected $_ch = null;

    protected $_timeout = 30; //超时时间 秒

    public function __construct($options = [])
    {
        if (isset($options['timeout'])) {
            $this->_timeout = $options['timeout'];
        }
    }

    public function get($url = null, array $options = [])
    {
        return $this->doRequest('GET', $url, $options);
    }

    public function post($url, array $options = [])
    {
        return $this->doRequest('POST', $url, $options);
    }

    public function put($url, array $options = [])
    {
        return $this->doRequest('PUT', $url, $options);
    }

    public function delete($url, array $options = [])
    {
        return $this->doRequest('DELETE', $url, $options);
    }


    public function patch($url, array $options = [])
    {
        return $this->doRequest('PATCH', $url, $options);
    }

    protected function _setParams($url, $method, $params)
    {
        if (true === strstr($url, 'https://', true)) {
            curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($this->_ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($this->_ch, CURLOPT_DNS_USE_GLOBAL_CACHE, 0);
            curl_setopt($this->_ch, CURLOPT_FOLLOWLOCATION, 1);
        }
        $method = strtoupper($method);
        switch ($method) {
            case 'PUT':
                $_putData = is_array($params) ? http_build_query($params) : $params;
                curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $_putData);
                break;
            case 'POST':
                $_postData = is_array($params) ? http_build_query($params) : $params;
                curl_setopt($this->_ch, CURLOPT_POST, true);
                curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $_postData);
                break;
            case 'DELETE':
                $_delData = is_array($params) ? http_build_query($params) : $params;
                curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $_delData);
                break;
            case 'PATCH':
                $_patchData = is_array($params) ? http_build_query($params) : $params;
                curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, "PATCH");
                curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $_patchData);
                break;
            case 'GET':
                $_getData = is_array($params) ? http_build_query($params) : $params;
                $uri = preg_match('/\?/', $url) ? '&' . $_getData : '?' . $_getData;
                $url = $url . $uri;
                break;
        }
        curl_setopt($this->_ch, CURLOPT_URL, $url);
    }

    public function doRequest($method, $url, $options=[])
    {
        $headers = [];
        if(isset($options['headers'])) {
            $headers = $options['headers'];
        }
        $params = [];
        if(isset($options['params'])) {
            $params = $options['params'];
        }
        $this->_ch = curl_init();
        $this->_setParams($url, $method, $params);
        curl_setopt($this->_ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_ch, CURLOPT_HEADER, 0);
        if(!empty($headers)) {
            curl_setopt($this->_ch, CURLOPT_HTTPHEADER, $headers);
        }
        $aRes = curl_exec($this->_ch);
        if ($error = curl_errno($this->_ch)) {
            return $this->_response([], $error, curl_error($this->_ch));
        }
        curl_close($this->_ch);
        return $this->_response($aRes, 0);

    }

    /**
     * curl结果返回数据处理
     *
     * @param array $data 业务数据
     * @param int $code  异常code, 0:表示正常，非0发生错误
     * @param string $msg 异常信息 异常信息，正确时为ok
     * @return array
     */
    protected function _response($data, $code = 0, $msg = 'ok')
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

}