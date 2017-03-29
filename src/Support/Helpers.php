<?php
namespace CjsSupport;
/**
 * 本文件是助手函数
 */

/**
 * 获取随机数
 * @param int $length
 * @return string
 */
function randStr($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for($i = 0; $i < $length; $i++)
    {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $str;
}

/**
 * 判断是否SSL协议
 * @return boolean
 */
function isSsl()
{
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return true;
    }
    return false;
}



/**
 * XML编码
 * @param mixed $data 数据
 * @param string $root 根节点名
 * @param string $item 数字索引的子节点名
 * @param string $attr 根节点属性
 * @param string $id 数字索引子节点key转换的属性名
 * @param string $encoding 数据编码
 * @return string
 */
function xml_encode($data, $root = 'ectouch', $item = 'item', $attr = '', $id = 'id', $encoding = 'utf-8')
{
    if (is_array($attr)) {
        $_attr = array();
        foreach ($attr as $key => $value) {
            $_attr[] = "{$key}=\"{$value}\"";
        }
        $attr = implode(' ', $_attr);
    }
    $attr = trim($attr);
    $attr = empty($attr) ? '' : " {$attr}";
    $xml = "<?xml version=\"1.0\" encoding=\"{$encoding}\"?>";
    $xml .= "<{$root}{$attr}>";
    $xml .= data_to_xml($data, $item, $id);
    $xml .= "</{$root}>";
    return $xml;
}

/**
 * 数据XML编码
 * @param mixed $data 数据
 * @param string $item 数字索引时的节点名称
 * @param string $id 数字索引key转换为的属性名
 * @return string
 */
function data_to_xml($data, $item = 'item', $id = 'id')
{
    $xml = $attr = '';
    foreach ($data as $key => $val) {
        if (is_numeric($key)) {
            $id && $attr = " {$id}=\"{$key}\"";
            $key = $item;
        }
        $xml .= "<{$key}{$attr}>";
        $xml .= (is_array($val) || is_object($val)) ? data_to_xml($val, $item, $id) : $val;
        $xml .= "</{$key}>";
    }
    return $xml;
}


/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parseName($name, $type=0)
{
    if ($type) {
        return ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));
    } else {
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
    }
}

function redirect($url, $time=0, $msg='')
{
    if (empty($msg)) {
        $msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
    }
    if (!headers_sent()) {
        if (0 === $time) {
            header('Location: ' . $url);
        } else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    } else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if ($time != 0) {
            $str .= $msg;
        }
        exit($str);
    }
}

function array_get($array, $key, $default = null)
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

/**
 * 是否在微信内
 * @param string $str
 * @return bool
 */
function isWeixin($str='')
{ 
	$str = $str?:$_SERVER['HTTP_USER_AGENT'];
    if ( strpos($str, 'MicroMessenger') !== false ) {
        return true;
    }  
    return false;
}

/**
 * 是否windows系统
 * @return bool
 */
function isWin() {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        return true;
    } else {
        return false;
    }
}

function isCli() {
    $sapi_type = php_sapi_name();
    if (substr($sapi_type, 0, 3) == 'cgi') {
        return true;
    } else {
        return false;
    }

}

/**
 * 只支持三段式的,每段最多三位
 * @param $version
 * @return int
 */
function versionToNum($version) {
    $tmp = explode(".", $version);
    switch(count($tmp)) {
        case 1:
            $number = $tmp[0];
            break;
        case 2:
            $number = $tmp[0]*1000+$tmp[1];
            break;
        case 3:
            $number = $tmp[0]*1000000+$tmp[1]*1000+$tmp[2];
            break;
        case 4:
            $number = 0; //不支持
            break;
    }

    return $number;
}

/**
 * 匹配三段式版本
 * @param $version
 * @return bool
 */
function versionUtil($version) {
    if(preg_match('/^([\d]{1,3})\.([\d]{1,3})\.([\d]{1,3})$/', trim($version), $match)) {
        return $match;
    } else {
        return false;
    }
}


function encode_php_tags($str)
{
    return str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $str);
}

function strip_slashes($str)
{
    if ( ! is_array($str))
    {
        return stripslashes($str);
    }
    foreach ($str as $key => $val)
    {
        $str[$key] = strip_slashes($val);
    }
    return $str;
}

function strip_quotes($str)
{
    return str_replace(array('"', "'"), '', $str);
}

function dd()
{
    if (func_num_args() === 0) {
        return;
    }
    $variables = func_get_args();
    var_dump($variables);
    die;
}

function echo_exception(\Exception $e)
{
    $code = $e->getCode();
    $msg = $e->getMessage();
    $trace = $e->getTraceAsString();
    echo <<<EOF
###################################################################################
          \033[1;31m a exception\033[0m
          code: $code
          message: $msg

$trace
###################################################################################
EOF;
}

function json_encode($data, $options=null)
{
    if(is_null($options)) {
        $options = 0;
        if (defined('JSON_UNESCAPED_SLASHES')) {
            $options |= JSON_UNESCAPED_SLASHES;
        }
        if (defined('JSON_UNESCAPED_UNICODE')) {
            $options |= JSON_UNESCAPED_UNICODE;
        }
    }
    return \json_encode($data, $options);
}

function with($object) {
    return $object;
}

function matchCase($value, $comparison)
{
    $functions = array('mb_strtolower', 'mb_strtoupper', 'ucfirst', 'ucwords');
    foreach ($functions as $function)
    {
        if (call_user_func($function, $comparison) === $comparison)
        {
            return call_user_func($function, $value);
        }
    }
    return $value;
}

/**
 * br转换行符
 *
 * @param $string
 * @return mixed
 */
function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, $string);
}

/**
 * 换行符转br
 *
 * @param $string
 * @return string
 */
function nl2br($string)
{
    return nl2br($string, true);
}

