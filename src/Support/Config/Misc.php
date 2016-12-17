<?php
namespace CjsSupport\Config;
/**
 * 配置单例
 * CjsSupport\Config\Misc::getInstance()->getSex();
 */
class Misc {

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
     * 性别配置
     * @param null $type
     * @return array|string
     */
    public function getSex($type=null, $default='')
    {
        $configTmp = [
            0 => '保密',
            1 => '男',
            2 => '女',
        ];
        if(is_null($type)) {
            return $configTmp;
        }
        if(isset($configTmp[$type])){
            return $configTmp[$type];
        }
        return $default;
    }

    /**
     * 地址类型配置
     * @param null $type
     * @return array|string
     */
    public function getAddressType($type=null, $default='')
    {
        $configTmp = [
            0 => '无',
            1 => '住宅',//家
            2 => '公司',
            3 => '学校',
            9 => '其他',
        ];
        if(is_null($type)) {
            return $configTmp;
        }
        if(isset($configTmp[$type])){
            return $configTmp[$type];
        }
        return $default;
    }

    /**
     * 车牌颜色
     * @param null $type
     */
    public function chepaiColor($type=null, $default='')
    {
        $configTmp = [
            1 => '蓝牌',
            2 => '黄牌',
            3 => '黑牌',
        ];
        if(is_null($type)) {
            return $configTmp;
        }
        if(isset($configTmp[$type])){
            return $configTmp[$type];
        }
        return $default;

    }

}
