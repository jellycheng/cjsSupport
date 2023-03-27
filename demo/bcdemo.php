<?php
require_once __DIR__ . '/common.php';
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2019/6/23
 * Time: 21:51
 */
$a = 0.1;
$b = 0.7;
var_dump(($a + $b) == 0.8); //false


$a = 0.1;
$b = 0.7;
var_dump(bcadd($a,$b,1) == 0.8); //true
echo bcadd($a, $b, 1) . PHP_EOL; //0.8
echo bcadd($a, $b, 2) . PHP_EOL; //0.80
echo "===========" . PHP_EOL;

echo  "scale=". \CjsSupport\Bc\Bcmath::getInstance()->getScale() . PHP_EOL;

echo "add===========" . PHP_EOL;
//相加
echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'add') . PHP_EOL;//0
echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'add', 2) . PHP_EOL;//0.80

echo "sub===========" . PHP_EOL;
//相减
echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'sub') . PHP_EOL;//-0
echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'sub', 2) . PHP_EOL;//-0.60
echo \CjsSupport\Bc\Bcmath::getInstance()->setScale(2)->calc(0.8, 0.7, 'sub') . PHP_EOL;//0.10
\CjsSupport\Bc\Bcmath::getInstance()->restoreScale();

echo "mul===========" . PHP_EOL;
//相乘
echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'mul') . PHP_EOL;//0
echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'mul', 2) . PHP_EOL;//0.07

//echo \CjsSupport\Bc\Bcmath::getInstance()->calc(0.1, 0.7, 'xxx', 2) . PHP_EOL;//抛异常了

echo \CjsSupport\fen2yuan(-101) . PHP_EOL;
echo \CjsSupport\fen2yuan(200) . PHP_EOL;


echo "finish" . PHP_EOL;
