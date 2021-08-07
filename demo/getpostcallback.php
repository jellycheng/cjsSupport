<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2021/8/7
 * Time: 18:14
 * 获取第三方回调内容
 */
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Shanghai');

$callbackContent = PHP_EOL . "==========start:" . date('Y-m-d H:i:s') . "==========" . PHP_EOL;

// 请求头
$headers = array();
foreach ($_SERVER as $key => $value) {
    if ('HTTP_' == mb_substr($key, 0, 5)) {
        $headers[str_replace('_', '-', mb_substr($key, 5))] = $value;
    }
}
$callbackContent .= "header:" . var_export($headers, true) . PHP_EOL . PHP_EOL;
$callbackContent .= "get:" . var_export($_GET, true) . PHP_EOL . PHP_EOL;
$callbackContent .= "post:" . var_export($_POST, true) . PHP_EOL . PHP_EOL;
$callbackContent .= "body:" . file_get_contents('php://input') . PHP_EOL . PHP_EOL;

$callbackContent .= "==========end:" . date('Y-m-d H:i:s') . "==========" . PHP_EOL;

// 指定保存文件位置
$fileName = __DIR__ . "/logs/" . date('Y-m-d') . ".log";
$dirName = dirname($fileName);
if(!file_exists($dirName)) {
    mkdir($dirName, 0755, true);
}
file_put_contents($fileName, $callbackContent, FILE_APPEND);

$retType = 1;
$retCon = "";
switch($retType) {
    case 1:
        $retCon = <<<EOT1
<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>
EOT1;
        break;
    default:
        $retCon = "";
        break;
}

echo $retCon . PHP_EOL;
