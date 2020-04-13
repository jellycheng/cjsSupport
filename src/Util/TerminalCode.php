<?php
namespace CjsSupport\Util;

/**
 * 终端类型代号, android app, ios app, h5, pc web网站等
 */
class TerminalCode
{
    //终端(场景): 代号字母要唯一, 代号数字也要唯一

    const ANDROID_APP = 'A'; //android app代号

    const ANDROID_IPAD = 'AI'; //android ipad代号

    const IOS_APP = 'I'; //iphone app代号

    const IOS_IPAD = 'II'; //iphone app代号

    const H5 = 'H'; //h5网站代号--浏览器中访问

    const H5_WEIXIN = 'HW'; //h5网站在微信内访问代号, 微信内嵌入h5

    const H5_ANDROID_APP = 'HA';

    const H5_IOS_APP = 'HI';

    const PC_WEB = 'W'; //pc网站代号

    //终端
    protected static $config = [
        self::ANDROID_APP => ['name' => 'Android App', 'num'=>2],
        self::ANDROID_IPAD => ['name' => 'Android Ipad', 'num'=>9],
        self::H5 => ['name' => 'h5网站', 'num'=>3],
        self::H5_WEIXIN => ['name' => '微信嵌入h5网站', 'num'=>7],
        self::IOS_APP => ['name' => 'Iphone App', 'num'=>1],
        self::IOS_IPAD => ['name' => 'Ios Ipad', 'num'=>8],
        self::PC_WEB => ['name' => 'pc web网站', 'num'=>4],
        self::H5_ANDROID_APP => ['name' => 'Android app嵌入h5', 'num'=>6],
        self::H5_IOS_APP => ['name' => 'Iphone app嵌入h5', 'num'=>5],
    ];

    public static function getConfig() {
        return self::$config;
    }

    /**
     * @param null $key = 'A'
     * @return array|string
     */
    public static function getName($key = null)
    {

        $config = self::$config;
        if (is_null($key)) {
            $nameAry = [];
            foreach($config as $k=>$v) {
                $nameAry[$k] = $v['name'];
            }
            return $nameAry;
        }
        $key = strtoupper($key);
        return isset($config[$key]) ? $config[$key]['name'] : '';

    }

    /**
     *
     * @param string $key = 'A'
     * @return array|string
     */
    public static function getNum($key = null)
    {

        $config = self::$config;
        if (is_null($key)) {
            $codeAry = [];
            foreach($config as $k=>$v) {
                $codeAry[$k] = $v['num'];
            }
            return $codeAry;
        }
        $key = strtoupper($key);
        return isset($config[$key]) ? $config[$key]['num'] : '';

    }

    /**
     * 通过数字获取字母代号
     *
     * @param int $num
     */
    public static function getCode4Num($num=null) {
        $config = self::$config;
        $tmpC = [];
        foreach($config as $k=>$v) {
            $v['code'] = $k;
            $tmpC[$v['num']] = $v;
        }
        if(is_null($num)) {
            return $tmpC;
        }

        return isset($tmpC[$num]) ? $tmpC[$num]['code'] : '';
    }

}