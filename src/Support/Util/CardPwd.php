<?php
/**
 * 卡密算法
 * Created by PhpStorm.
 * User: jelly
 * Date: 2020/3/1
 * Time: 19:47
 * $res = CardPwd::generate(789, 9000);
    var_export($res);
    echo "长度：" . strlen($res[2]) . PHP_EOL;
    $tmp = array_unique($res);
    echo count($tmp) . PHP_EOL;
 */

namespace CjsSupport\Util;


class CardPwd
{

    /**
     * @param string $partVal 卡密参考值，一般传当天累计生成批次号数
     * @param int $num 卡密数量
     * @param int $type 参与随机字符的方式
     * @return array
     */
    public static function generate($partVal = '1', $num = 100, $type = 1) {
        $ret = [];
        if($num<=0) {
            return $ret;
        }

        $ymd = static::ymdTo3(0, 0);
        for($i=1;$i<=$num;$i++) {
            //年月日，当日第partVal次生成，递增值，随机字符串
            $ret[] = sprintf("%s%s%s%s", $ymd,$partVal,$i, static::randStr(6, $type));
        }
        return $ret;
    }
    //去除输入有争议的字符
    public static function randStr($length = 16, $type = 0) {
        //l、o、L、O、数字0、数字1
        if($type == 1) {
            $chars = "ABCDEFGHIJKMNPQRSTUVWXYZ23456789";
        } else {
            $chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ23456789";
        }
        $str = "";
        for($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }

    public static function ymdTo3($time = 0, $type = 0) {
        if(!$time) {
            $time = time();
        }
        if($type == 1) {
            return date('z', $time);
        } else {
            $year = date('y', $time);
            $month = date('n', $time);
            $day = date('j', $time);
            $chars = str_split("9ABCDEFGHIJKMNPQRSTUVWXYZ23456789", 1);
            return $chars[$year] . $chars[$month] . $chars[$day];
        }

    }
}

