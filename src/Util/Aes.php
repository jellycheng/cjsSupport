<?php
namespace CjsSupport\Util;

// Aes 对称加密
class Aes
{
    //加解密方法，可通过openssl_get_cipher_methods()获得
    protected $method;

    //加解密的密钥
    protected $secret_key;

    // 加解密的向量，有些方法需要设置比如CBC
    protected $iv;
    protected $options;

    /**
     * @param string $key 密钥
     * @param string $method 加密方式
     * @param string $iv iv向量
     * @param mixed $options
     */
    public function __construct($key, $method = 'AES-256-CBC', $iv = '', $options = 1)
    {
        // secret_key是必须要设置的
        $this->secret_key = isset($key) ? $key : 'cjs';
        $this->method = $method;
        $this->iv = $iv ? $iv : substr($key, 0, 16);
        $this->options = $options;
    }

    /**
     * 加密方法，对数据进行加密，返回加密后的数据
     *
     * @param string $data 要加密的数据
     * @return string
     */
    public function encrypt($data)
    {
        $encryptData = openssl_encrypt($data, $this->method, $this->secret_key, $this->options, $this->iv);
        return self::base64url_encode($encryptData);
    }

    /**
     * 解密方法，对数据进行解密，返回解密后的数据
     *
     * @param string $data 要解密的数据
     * @return string
     */
    public function decrypt($data)
    {
        $data = self::base64url_decode($data);
        return openssl_decrypt($data, $this->method, $this->secret_key, $this->options, $this->iv);
    }

    /**
     * url安全的base64加密
     * @param $data
     * @return string
     */
    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * url安全的base64解密
     * @param $data
     * @return false|string
     */
    public static function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($data)) % 4));
    }

}