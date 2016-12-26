<?php
require_once __DIR__ . '/common.php';

$obj = \CjsSupport\Enum\RedisGroupEnum::getInstance();
echo $obj['USER'] . PHP_EOL;

echo \CjsSupport\Enum\RedisGroupEnum::toString() . PHP_EOL;


var_export(\CjsSupport\Enum\RedisGroupEnum::toArray());
echo PHP_EOL;


