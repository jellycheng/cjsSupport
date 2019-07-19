<?php
/**
 * oauth相关类
 * Created by PhpStorm.
 * User: jelly
 * Date: 2019-07-19
 * Time: 16:28
 */

namespace CjsSupport\Util;


class Oauth
{
    public static function getBasicValue($username, $pwd) {
        return base64_encode($username . ":" . $pwd);
    }


    public static function getAuthorizationHeaderFormat($baseic) {
        $header = "Authorization: Basic " . $baseic;
        return $header;
    }

}