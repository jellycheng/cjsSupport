<?php
namespace CjsSupport\Config;

/**
 * 车牌简称
 */
class Chepai
{

    private function __construct()
    {

    }

    public static function getInstance()
    {
        static $obj;
        if (!$obj) {
            $obj = new static();
        }
        return $obj;
    }

    /**
     *
     * @param null $id
     * @param string $default
     * @return array|string
     */
    public function get($id = null, $default = '')
    {
        $config = [
            1 => '京',
            2 => '津',
            3 => '冀',
            4=> '晋',
            5=> '蒙',
            6=> '辽',
            7=> '吉',
            8=> '黑',
            9=> '沪',
            10=> '苏',
            11=> '浙',
            12=> '皖',
            13=> '闽',
            14=> '赣',
            15=> '鲁',
            16=> '豫',
            17=> '鄂',
            18=> '湘',
            19=> '粤',
            20=> '桂',
            21=> '琼',
            22=> '川',
            23=> '贵',
            24=> '云',
            25=> '渝',
            26=> '藏',
            27=> '陕',
            28=> '甘',
            29=> '青',
            30=> '宁',
            31=> '新',
            32=>'港',
            33=>'澳',
            34=>'台',
        ];
        if (is_null($id)) {
            return $config;
        }
        if (isset($config[$id])) {
            return $config[$id];
        }
        return $default;
    }
}