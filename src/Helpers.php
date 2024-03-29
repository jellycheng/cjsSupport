<?php
namespace CjsSupport;

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
 * /e参数，在php5.6开始报警告错误，php7完全废弃/e参数，使用preg_replace_callback函数替换
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
//兼容php5.6和php7写法
function parseName2($name, $type=0) {
    if(!$name) {
        return $name;
    }
    switch($type) {
        case 0:
            return ucfirst(preg_replace_callback("/_([a-zA-Z])/",
                    function($v) {
                        return strtoupper($v[1]);
                    },
                    $name)
            );
            break;
        case 1:
            return preg_replace_callback("/_([a-zA-Z])/",
                function($v) {
                    return strtoupper($v[1]);
                },
                $name);
            break;
        case 2:
            return ucfirst(preg_replace_callback("/_([a-zA-Z0-9])/",
                    function($v) {
                        return strtoupper($v[1]);
                    },
                    $name)
            );
            break;
        case 3:
            return preg_replace_callback("/_([a-zA-Z0-9])/",
                function($v) {
                    return strtoupper($v[1]);
                },
                $name);
            break;
        case 4:
            //大写字母转下划线
            return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
            break;
        default:
            return $name;
            break;
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

function array_set(&$array, $key, $value)
{
    if (is_null($key)) {
        return $array = $value;
    }
    $keys = explode('.', $key);

    while (count($keys) > 1) {
        $key = array_shift($keys);
        if (! isset($array[$key]) || ! is_array($array[$key])) {
            $array[$key] = [];
        }
        $array = &$array[$key];
    }
    $array[array_shift($keys)] = $value;
    return $array;
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

function array_has($array, $key)
{
    if (empty($array) || is_null($key)) return false;
    if (array_key_exists($key, $array)) return true;
    foreach (explode('.', $key) as $segment)
    {
        if ( ! is_array($array) || ! array_key_exists($segment, $array))
        {
            return false;
        }
        $array = $array[$segment];
    }
    return true;
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
    return \nl2br($string, true);
}

/**
 * Convert a string to snake case.
 * 把字符串转成蛇形命名,如 fooBar转成 foo_bar
 * @param  string  $value
 * @param  string  $delimiter 分隔符,默认_
 * @return string
 */
function str_snake($value, $delimiter = '_')
{
    static $snakeCache;
    $key = $value.$delimiter;

    if (isset($snakeCache[$key]))
    {
        return $snakeCache[$key];
    }

    if ( ! ctype_lower($value))
    {
        $value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1'.$delimiter, $value));
    }

    return $snakeCache[$key] = $value;
}


function studly($value)
{
    static $studlyCache;
    $key = $value;
    if (isset($studlyCache[$key])) {
        return $studlyCache[$key];
    }
    $value = ucwords(str_replace(['-', '_'], ' ', $value));
    return $studlyCache[$key] = str_replace(' ', '', $value);
}

function startsWith($str, $startStr) {
    if ($startStr != '' && mb_strpos($str, $startStr) === 0) {
        return true;
    }
    return false;
}


//去掉前缀
function trimPrefix($str, $prefix, $encode = 'UTF-8') {
    if(startsWith($str, $prefix)) {
        $start = mb_strlen($prefix);
        return mb_substr($str, $start, null, $encode);
    } else {
        return $str;
    }

}


//获取用户家目录
function getUserDir()
{
    $userEnv = defined('PHP_WINDOWS_VERSION_MAJOR') ? 'APPDATA' : 'HOME';
    $userDir = getenv($userEnv);
    return rtrim(strtr($userDir, '\\', '/'), '/');
}


function getRequestMethod($default = '') {
    return isset($_SERVER['REQUEST_METHOD'])?strtoupper($_SERVER['REQUEST_METHOD']):$default;
}

//获取今天的开始和结束时间戳
function getTodaySEtime() {
	$time = time();
	return getSEtime($time);
}

//获取指定时间戳那日的开始和结束时间戳
function getSEtime($time) {
	$date = date("Y-m-d", $time);
	$ret = [
			's_time'=>strtotime($date . " 0:0:0"),
			'e_time'=>strtotime($date . " 23:59:59")
	];
	return $ret;
}


//2个时间戳相差天数：0表同一天，1表隔1天，以此类推
function diffDay($time1, $time2) {
	if($time1<$time2) {
		$tmp = $time1;
		$time1 = $time2;
		$time2 = $tmp;
	}
	return date('z', $time1) - date('z', $time2);
}


/**
 * @param $module  如 User\\UserLogin
 * @param $method  如 login
 * @param array $param
 * @param array $ext
 *  - string id 请求id
 * @return string
 */
function getRequestRpcJson($module, $method = '', $param=[], $ext = []) {
    $requestId = isset($ext['id'])?$ext['id']:"test_".mt_rand(10000, 99999);
    if($module && $method) {
        $tmpMethod = $module . '.' . $method;
    } else if($module) {
        $tmpMethod = $module;
    } else if($method) {
        $tmpMethod = $method;
    } else {
        $tmpMethod = '';
    }
    $json = [
        'jsonrpc'=>'2.0',
        'method'=>$tmpMethod,
        'id'=>$requestId,
    ];
    if($param){
        $json['params']=$param;
    }
    $options = 0;
    if (defined('JSON_UNESCAPED_SLASHES')) {
        $options |= JSON_UNESCAPED_SLASHES;
    }
    if (defined('JSON_UNESCAPED_UNICODE')) {
        $options |= JSON_UNESCAPED_UNICODE;
    }
    return json_encode($json, $options);
}

//过滤掉emoji表情, 长度>=4个字节的
function filterEmoji($str) {
    $str = preg_replace_callback('/./u',
                                function (array $match) {
                                    return strlen($match[0]) >= 4 ? '' : $match[0];
                                }, $str);
    return $str;
}

/**
 * 把字符串分隔成目录结构
 * 一般目录可由字母、数字、-、_等组成 + 分隔符 组成正则合法验证
*/
function string2Dir($string, $separation='_') {
	if(!$string || !$separation || !preg_match('/^[a-z0-9\-_\.]+$/i', $string)) {
		return $string;
	}
	
	$reg = '/' . $separation . '/i';
	if(preg_match($reg, $string)) {
		$ret = str_replace($separation, '/', $string);
	} else {
		$ret = $string;
	}

	//$dir = ucfirst(preg_replace_callback('/(_|-|\.)([a-zA-Z])/', function($match){return '/'.strtoupper($match[2]);}, $string));
	//echo $dir. PHP_EOL;// Abc/Hello/A123-45
	return $ret;
}

//$param = \CjsSupport\splitUrlPath("abc/xyz/hello/world/user/123");
function splitUrlPath($url) {
    $params = [];
    if ($url) {
        // /(\w+)\/([^\/]+)/'
        preg_replace_callback('/([a-zA-Z0-9_\-\.]+)\/([^\/]+)/', function ($match) use (&$params) {
            $params[strtolower($match[1])] = $match[2];
        }, $url);
    }
    return $params;
}


function getVerifyVal($str) {
    $ret = "";
    if($str) {
        $str = trim($str);
    } else {
        return $ret;
    }
    $verifyPattern = "/^(WW|MP)_verify_([0-9a-zA-Z]{16}).txt$/i";
    if(preg_match($verifyPattern, $str, $m)) {
        if(isset($m[2])) {
            return $m[2];
        }
    }
    return $ret;
}

// 分转元
function fen2yuan($price, $default = '0.00'){
    if(empty($price)){
        return $default;
    }
    $res = bcdiv($price, 100, 2);
    return strval($res);
}

