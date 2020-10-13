<?php
namespace CjsSupport\Util;


class Header
{
    public static function getServerData($key = null, $default = '') {
        if(is_null($key)) {
            return $_SERVER;
        } else {
            return isset($_SERVER[$key])?$_SERVER[$key]:$default;
        }
    }

    public static function getAllHeaders() {
        $ret = [];
        foreach($_SERVER as $k=>$v) {
            if(preg_match('/^HTTP_/i', $k)) {
                $ret[$k] = $v;
            }
        }
        return $ret;
    }

}