<?php
namespace CjsSupport\Util;

class Cipher
{
    const IV_SIZE = 16;
    const PASSWORD = 'guo2016_2099';

    /**
     * 加密
     *
     * @param mixed $input
     * @return string
     */
    public static function encrypt($input, $key='')
    {
        $key=$key?:self::PASSWORD;
        $iv = substr(uniqid("", true), 0, self::IV_SIZE);
        $encrypted = openssl_encrypt($input, "AES-256-CBC", md5($key), 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    /**
     * 解密
     *
     * @param string $input
     * @return string
     */
    public static function decrypt($input, $key='')
    {
        $key=$key?:self::PASSWORD;
        $input = base64_decode($input);
        $iv = substr($input, 0, Cipher::IV_SIZE);
        return openssl_decrypt(substr($input, self::IV_SIZE), "AES-256-CBC", md5($key), 0, $iv);
    }

}

