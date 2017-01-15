<?php
namespace CjsSupport\Util;
/**
 * app类型
 */
class AppType {

    const APP_TYPE_BUY = 1;  //电商-买家app
    const APP_TYPE_MERCHANT = 2; //电商-商家app
    const APP_TYPE_COURIER = 3;  //电商-快递员app
    const APP_TYPE_MANAGE = 6;  //电商-manage后台
    const APP_TYPE_CHE = 4;    //车app

    /**
     * 通过英文代号获取对应数字
     *
     * @param string $app_source 来源app：buy表示买家app，merchant表示商家app，courier表示快递员app
     * @return int
     */
    public static function appTypeCode($app_type) {
        $app_type = strtolower($app_type);
        switch($app_type) {
            case 'che':
                //车app
                $reg_platform = self::APP_TYPE_CHE;
                break;
            case 'buy':
                $reg_platform = self::APP_TYPE_BUY;
                break;
            case 'merchant':
                $reg_platform = self::APP_TYPE_MERCHANT;
                break;
            case 'courier':
                $reg_platform = self::APP_TYPE_COURIER;
                break;
            case 'manage':
                //管理员后台开通
                $reg_platform = self::APP_TYPE_MANAGE;
                break;
            default:
                $reg_platform = 0;
                break;
        }
        return $reg_platform;
    }

    /**
     * 通过数字代号获取英文代号
     *
     * @param int $code 来源app：1.buy表示买家app，2.merchant表示商家app，3.courier表示快递员app
     */
    public static function appType($code) {
        $code = intval($code);
        switch($code) {
            case self::APP_TYPE_CHE:
                $str = 'che';
                break;
            case self::APP_TYPE_BUY:
                $str = 'buy';
                break;
            case self::APP_TYPE_MERCHANT:
                $str = 'merchant';
                break;
            case self::APP_TYPE_COURIER:
                $str = 'courier';
                break;
            case self::APP_TYPE_MANAGE:
                //管理员后台
                $str = 'manage';
                break;
            default:
                $str = '';
                break;
        }
        return $str;
    }

}