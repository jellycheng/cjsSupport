<?php
namespace CjsSupport\Util;

class Sign
{

    public static function BodyContentMd5Sign($body, $secret) {
        $str = sprintf("%s\n%s", $body, $secret);
        return md5($str);
    }

}