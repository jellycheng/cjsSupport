<?php
/**
 *
 */
require __DIR__ . '/common.php';

$config = \CjsSupport\Util\TerminalCode::getConfig();
var_export($config);
echo PHP_EOL;

//var_export(\CjsSupport\Util\TerminalCode::getName());

//var_export(\CjsSupport\Util\TerminalCode::getName('I'));

echo \CjsSupport\Util\TerminalCode::getName(\CjsSupport\Util\TerminalCode::IOS_APP).PHP_EOL;


echo \CjsSupport\Util\TerminalCode::getNum(\CjsSupport\Util\TerminalCode::IOS_APP).PHP_EOL;

var_export(\CjsSupport\Util\TerminalCode::getCode4Num());
echo PHP_EOL;


echo \CjsSupport\Util\TerminalCode::getCode4Num(4) . PHP_EOL;
