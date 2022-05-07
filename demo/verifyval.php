<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2022/5/7
 * Time: 09:49
 */
require __DIR__ . '/common.php';

$str = "MP_verify_d4RP2dwJOG3lDBub.txt";
echo \CjsSupport\getVerifyVal($str) . PHP_EOL;

$str = "WW_verify_P3fNz9uLSkgAlsnI.txt";
echo \CjsSupport\getVerifyVal($str) . PHP_EOL;

$str = "xx_verify_P3fNz9uLSkgAlsnI.txt";
echo \CjsSupport\getVerifyVal($str) . PHP_EOL;

$str = "abc/xxx/WW_verify_P3fNz9uLSkgAlsnI.txt";
echo \CjsSupport\getVerifyVal($str) . PHP_EOL;



