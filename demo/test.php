<?php
require_once __DIR__ . '/common.php';


echo \CjsSupport\Util\Format::factory(array('foo' => 'bar', 'hi'=>'cjs'))->toJson();
echo PHP_EOL;

echo \CjsSupport\Util\Format::factory(array('foo' => 'bar', 'hi'=>'cjs'))->toCSV();
echo PHP_EOL;

echo \CjsSupport\Util\Format::factory(array('foo' => 'bar', 'hi'=>'cjs'))->toSerialized();
echo PHP_EOL;


echo \CjsSupport\Util\Format::factory(array('foo' => 'bar', 'hi'=>'cjs'))->toPHP();
echo PHP_EOL;


echo \CjsSupport\Util\Format::factory('a:2:{s:3:"foo";s:3:"bar";s:2:"hi";s:3:"cjs";}', 'serialize')->toPHP();
echo PHP_EOL;


echo \CjsSupport\Util\Format::factory(array('foo' => 'bar', 'hi'=>'cjs', 1=>22,2=>3))->toXML();
echo PHP_EOL;


$isEmail = new \CjsSupport\Util\RegExp('/^\w+@\w+\.\w+$/');
$b = $isEmail('test@qq.com');
var_dump($b);
