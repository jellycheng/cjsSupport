<?php
require_once __DIR__ . '/common.php';

class Hello {
    use  CjsSupport\CjsTrait\Macroable;

    public function abc() {

        echo 'abc' . PHP_EOL;
    }

}

//扩展宏方法
Hello::macro('sayHi', function($param){
    echo sprintf("Hello %s" . PHP_EOL, $param);
});

Hello::sayHi("world");

$obj = new Hello();
echo $obj->sayHi("jelly");

