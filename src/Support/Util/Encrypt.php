<?php
namespace CjsSupport\Util;

class Encrypt {

    protected $pwdPrefix = "win_ma_nong_"; //密码前缀

    protected $saltPrefix = "win-ma-nong-"; //salt前缀

    public function getInstance() {
        return new static();
    }

    public function setPrefix($pwdPrefix, $saltPrefix) {
        $this->pwdPrefix = $pwdPrefix;
        $this->saltPrefix = $saltPrefix;
        return $this;
    }

    /**
     * 加密密码
     *
     * @param string $pwd 明文密码
     * @param string $salt 加密盐值
     * @return string 加密后的结果
     */
    public function encodePwd($pwd, $salt)
    {
        if (empty($pwd) || empty($salt)) {
            return '';
        }
        $encodePwd = md5( $this->pwdPrefix. $pwd);
        $encodePwd = md5($this->saltPrefix . $encodePwd . $salt);
        return $encodePwd;
    }

    /**
     * 验证密码
     *
     * @param string $pwd 待验证的密码
     * @param string $salt 加密盐值
     * @param string $encodePwd 加密后的密码
     * @return bool
     */
    public function decodePwd($encodePwd, $pwd, $salt='')
    {
        $pwd = $this->encodePwd($pwd, $salt);
        if ($pwd == $encodePwd) {
            return true;
        } else {
            return false;
        }
    }


    public function getSalt($length) {
        return $this->generateSalt($length);
    }

    /**
     * 生成加密盐值
     *
     * @return string 盐值(4-32位)
     */
    public static function generateSalt($length=0)
    {
        if(!$length) {
            $length = mt_rand(4, 32);
        }
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $salt = "";
        for($i = 0; $i < $length; $i++)
        {
            $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $salt;
    }

}