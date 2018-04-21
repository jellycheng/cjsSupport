<?php
namespace CjsSupport\DataManage;

class CookieData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_COOKIE;
    }

    /**
     * 发送cookie
     * @param $name
     * @param string $value
     * @param int $expire
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     * @return bool
     */
    public function setcookie($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false) {
        return setcookie($name, $value, $expire, $path, $domain, $secure = false, $httponly = false);
    }


}


