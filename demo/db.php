<?php
require_once __DIR__ . "/common.php";

$cartObj = \CjsSupport\Util\CartDBUtil::getInstance();
$str = "5466935782086561357";
var_export($cartObj->getDBBaseByStr($str));
echo PHP_EOL;
echo $str . "的hash值%128=" .$cartObj->getHashOrd($str) . PHP_EOL;

$str2 = 1000000002;
var_export($cartObj->getDBBaseByNum($str2));
echo PHP_EOL;

