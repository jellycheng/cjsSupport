<?php
namespace CjsSupport\Console;

class Color
{
    protected static $colors = [
                                'off'    => "\033[0m",
                                'black'  => "\033[30m",
                                'red'    => "\033[31m",
                                'green'  => "\033[32m",
                                'yellow' => "\033[33m",
                                'blue'   => "\033[34m",
                                'purple' => "\033[35m",
                                'cyan'   => "\033[36m",
                                'white'  => "\033[37m"
                            ];

    /**
     * @return array
     */
    public static function getColors($key = null)
    {
        if(is_null($key)) {
            return self::$colors;
        } else if(isset(self::$colors[$key])){
            return self::$colors[$key];
        }
        return '';
    }

    /**
     * @param array $colors
     */
    public static function setColors($key, $val = '')
    {
        if(is_array($key)) {
            self::$colors = array_merge(self::$colors, $key);
        } else {
            self::$colors[$key] = $val;
        }

    }



    public static function color($name, $msg)
    {
        return sprintf("%s%s\033[0m", self::$colors[$name], $msg);
    }

    public static function black($msg)
    {
        return self::color('black', $msg);
    }

    public static function red($msg)
    {
        return self::color('red', $msg);
    }

    public static function green($msg)
    {
        return self::color('green', $msg);
    }

    public static function yellow($msg)
    {
        return self::color('yellow', $msg);
    }

    public static function blue($msg)
    {
        return self::color('blue', $msg);
    }

    public static function purple($msg)
    {
        return self::color('purple', $msg);
    }

    public static function cyan($msg)
    {
        return self::color('cyan', $msg);
    }

    public static function white($msg)
    {
        return self::color('white', $msg);
    }
}
