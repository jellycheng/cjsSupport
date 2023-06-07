<?php
require_once __DIR__ . '/common.php';

$plainText = 'hello 你好 php composer';  // 要加密的数据
$key = 'XAvktw+qKWgOaEjBlfsHT5vzfqxVg123'; // 密钥
printf("明文：%s, 密钥:%s\n", $plainText, $key);

$aes = new \CjsSupport\Util\Aes($key);  // 实例化Aes类，并传递密钥key
// 加密
$cipherText = $aes->encrypt($plainText);
printf("加密后：%s\n", $cipherText);//加密后：CnyJgSYWbpeytAmmiN6Sd8racSeF2RikeX_Q5eO1HVA

// 解密
$data = $aes->decrypt($cipherText);
printf("解密后：%s\n", $data);

var_dump($data == $plainText);

