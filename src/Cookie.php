<?php
namespace CjsSupport;
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 16/9/10
 * Time: 下午8:15
 */
use ArrayAccess;
class Cookie implements ArrayAccess {

    /**
     * 储存COOKIE数据到一个数组
     * @var array
     */
    protected $_data = array();
    protected $domain = '';
    protected $path = '/';

    protected $secure = false;
    protected $httponly = false;
    protected $prefix = 'cjs_';

    public function __construct() {
        $this->_data = &$_COOKIE;
    }


    public function __destruct() {
        //unset($this->_data);
    }


    public function getRealKey($key) {
        return $this->prefix . $key;
    }
    public function getCookie($key, $isPrefix = true) {
        if($isPrefix) {
            $key = $this->getRealKey($key);
        }
        if(isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return '';
        }
    }
    public function setDomain($domain) {
        $this->domain = $domain;
        return $this;
    }

    public function setPrefix($prefix) {
        $this->prefix = $prefix;
        return $this;
    }
    public function setSecure($secure) {
        $this->secure = $secure;
        return $this;
    }
    public function setPath($path) {
        $this->path = $path;
        return $this;
    }

    public function setHttponly($httponly) {
        $this->httponly = $httponly;
        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value) {
        $key = $this->getRealKey($key);
        $this->_data[$key] = $value;
    }

    /**
     * 判断数据是否存在
     * @return boolean
     */
    public function offsetExists($key) {
        $key = $this->getRealKey($key);
        return isset($this->_data[$key]);
    }

    /**
     * 删除数据
     *
     */
    public function offsetUnset($key) {
        $key = $this->getRealKey($key);
        unset($this->_data[$key]);
    }

    /**
     * 获取数据
     *
     */
    public function offsetGet($key) {
        $key = $this->getRealKey($key);
        return isset($this->_data[$key]) ? $this->_data[$key] : '';
    }

    /**
     * 设置COOKIE字段中的数据
     * @param string $key   COOKIE数组中下标名字
     * @param string $value  值
     * @param int    $expire 缓存时间
     * @param string $mode   时间计算模式
     *
     * @return void
     */
    public function set($key, $value, $expire = 0, $mode = 'h') {
        if ($expire > 0) {
            switch ($mode) {
                case 's':
                    $time = 1;
                    break;
                case 'm':
                    $time = 60;
                    break;
                case 'h':
                    $time = 60 * 60;
                    break;
                case 'd':
                    $time = 60 * 60 * 24;
                    break;
                case 'y':
                    $time = 60 * 60 * 24 * 365;
                    break;
                default:
                    $time = 1;
                    break;
            }
            $expire = time() + $time * $expire;
        }
        $key = $this->getRealKey($key);
        setcookie($key, $value, $expire, $this->path, $this->domain, $this->secure, $this->httponly);
        $_COOKIE[$key] = $value;
        return $this;
    }

    public function clear($key)
    {
        $key = $this->getRealKey($key);
        setcookie($key, '', time()-360000, $this->path, $this->domain, $this->secure, $this->httponly);
        unset($_COOKIE[$key]);
        return $this;
    }

    /**
     * 生成单例实例
     *
     * @return Cookie
     */
    public static function instance() {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new static();
        }
        return $instance;
    }

}
