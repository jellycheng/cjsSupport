<?php
require __DIR__ . '/common.php';

//YWJjOjEyMzQ1Ng==
$basic = \CjsSupport\Util\Oauth::getBasicValue("abc", 123456);
echo $basic . PHP_EOL;
$s1 = \CjsSupport\Util\Oauth::getAuthorizationHeaderFormat($basic);
echo $s1 .PHP_EOL;
echo \CjsSupport\Util\Oauth::extractBearerCon($s1, "basic") . PHP_EOL;

$s2 = \CjsSupport\Util\Oauth::getAuthorizationBearerFormat($basic);
echo $s2 .PHP_EOL;
echo \CjsSupport\Util\Oauth::extractBearerCon($s2, "bearer") . PHP_EOL;
