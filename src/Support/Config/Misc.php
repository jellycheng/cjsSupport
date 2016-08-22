<?php
namespace CjsSupport\Config;
/**
 * 配置单例
 * CjsSupport\Config\Misc::getInstance()->getSex();
 */
class Misc
{

    private function __construct(){}
    public static function getInstance()
    {
        static $obj;
        if (!$obj) {
            $obj = new static();
        }
        return $obj;
    }

    //性别配置
    public function getSex($type=null)
    {
        $confitTmp = [
            0 => '保密',
            1 => '男',
            2 => '女',
        ];
        if(is_null($type)) {
            return $confitTmp;
        }
        if(isset($confitTmp[$type])){
            return $confitTmp[$type];
        }
        return '';
    }

    //地址类型配置
    public function getAddressType($type=null)
    {
        $confitTmp = [
            0 => '无',
            1 => '住宅',//家
            2 => '公司',
            3 => '学校',
            9 => '其他',
        ];
        if(is_null($type)) {
            return $confitTmp;
        }
        if(isset($confitTmp[$type])){
            return $confitTmp[$type];
        }
        return '';
    }

}
