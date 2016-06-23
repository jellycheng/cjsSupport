<?php
namespace CjsSupport\CjsTrait;

trait BaseTrait {

    protected function _e($value, $encoding='utf-8', $flags = ENT_QUOTES, $double_encode = false)
    {
        return htmlentities($value, $flags, $encoding, $double_encode);
    }

    protected function _htmlspecialchars($value, $encoding='utf-8', $flags = ENT_QUOTES, $double_encode = false)
    {
        return htmlspecialchars($value, $flags, $encoding, $double_encode);
    }

    protected function _array_get($array, $key, $default = null)
    {
        if (is_null($key)) return $array;
        if (isset($array[$key])) return $array[$key];
        $keyA = explode('.', $key);
        foreach ($keyA as $segment)
        {// a.b.c
            if ( ! is_array($array) || ! array_key_exists($segment, $array))
            {   //不存在的key则返回默认值
                return $default instanceof \Closure ? $default() : $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }

}