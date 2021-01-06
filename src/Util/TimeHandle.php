<?php
namespace CjsSupport\Util;

class TimeHandle
{

    public static function getInstance() {
        return new static();
    }

    /**
     * 时间转秒，支持的时间格式（三种）： 19，9:05，23:59:59
     * 小时0～23，分钟0～59，秒0～59
     * @param $time
     */
    public function time2Second($time) {
        $ret = [
            'is_ok'=>false, //时间格式是否正确,true格式正确，false格式错误
            'second'=>0, //秒
        ];
        $time = trim($time);
        if(!$time && $time != "0") {
            return $ret;
        }

        if(preg_match('/^(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9])$/', $time, $match)) {//时:分:秒
            $ret['is_ok'] = true;
            $ret['second'] = $match[1]*60*60 + $match[2]*60 + $match[3];
        } else if(preg_match('/^(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])$/', $time, $match)) {//时:分
            $ret['is_ok'] = true;
            $ret['second'] = $match[1]*60*60 + $match[2]*60;
        } else if(preg_match('/^(0?[0-9]|1[0-9]|2[0-3])$/', $time, $match)) { //时
            $ret['is_ok'] = true;
            $ret['second'] = $match[1]*60*60;
        } else {
            $ret['is_ok'] = false;
        }

        return $ret;
    }

    /**
     * @param $second 当日秒
     * @param int $format 1返回时格式，2返回时:分格式，3返回时:分:秒格式
     * @param bool $isPrefix 是否需要前导0，true需要，false不需要
     * @return string
     */
    public function second2time($second, $format=3, $isPrefix = true) {
        $ret = "";
        $second = intval($second);
        switch ($format) {
            case 1:
                $ret = floor($second/3600);
                if($isPrefix && $ret<10) {
                    $ret = "0" . $ret;
                }
                break;
            case 2:
                $hour = floor($second/3600); //时
                if($isPrefix && $hour<10) {
                    $ret = "0" . $hour;
                } else {
                    $ret = $hour;
                }
                $minute = floor(($second-$hour*3600)/60); //分
                if($isPrefix && $minute<10) {
                    $ret .= ":0" . $minute;
                } else {
                    $ret .= ":" . $minute;
                }
                break;
            case 3:
                $hour = floor($second/3600); //时
                if($isPrefix && $hour<10) {
                    $ret = "0" . $hour;
                } else {
                    $ret = $hour;
                }
                $minute = floor(($second-$hour*3600)/60); //分
                if($isPrefix && $minute<10) {
                    $ret .= ":0" . $minute;
                } else {
                    $ret .= ":" . $minute;
                }
                $s = $second%60; //秒
                if($isPrefix && $s<10) {
                    $ret .= ":0" . $s;
                } else {
                    $ret .= ":" . $s;
                }
                break;
        }
        return $ret;
    }

}
