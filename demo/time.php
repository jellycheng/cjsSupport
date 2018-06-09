<?php
require_once __DIR__ . '/common.php';


$ret = \CjsSupport\getTodaySEtime();
var_export($ret);
echo PHP_EOL;
echo date("Y-m-d H:i:s", $ret['s_time']) . PHP_EOL;
echo date("Y-m-d H:i:s", $ret['e_time']) . PHP_EOL;

echo \CjsSupport\diffDay($ret['s_time'], $ret['e_time']) . PHP_EOL;//0表是同一天
echo \CjsSupport\diffDay($ret['s_time']-86400, $ret['e_time']) . PHP_EOL; //1表隔1天
echo \CjsSupport\diffDay($ret['s_time'], $ret['e_time']+86400*5) . PHP_EOL;

