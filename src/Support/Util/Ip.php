<?php
namespace CjsSupport\Util;
/**
 * ip类
 * User: jelly
 * Date: 2019-06-06
 * Time: 11:10
 */
class Ip {

    /**
     * 获取客户端IP
     * @return string
     */
    public static function getClientIP() {
        $ip = '';
        if(isset($_SERVER['HTTP_REALIP']) && $_SERVER['HTTP_REALIP']) {
            $ip = $_SERVER['HTTP_REALIP'];
        } else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if (empty($ip)) {
            $ip = '0.0.0.0';
        }
        return $ip;
    }

}