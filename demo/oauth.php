<?php
require __DIR__ . '/common.php';

//YWJjOjEyMzQ1Ng==
$basic = \CjsSupport\Util\Oauth::getBasicValue("abc", 123456);
echo $basic . PHP_EOL;
echo \CjsSupport\Util\Oauth::getAuthorizationHeaderFormat($basic) . PHP_EOL;

