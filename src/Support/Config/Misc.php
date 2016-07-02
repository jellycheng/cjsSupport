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
    public function getSex()
    {

        return [
            0 => '保密',
            1 => '男',
            2 => '女',
        ];
    }

}
