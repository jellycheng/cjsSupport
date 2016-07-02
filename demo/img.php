<?php
/**
 *
 */
require 'common.php';
$url = "http://img.dev.qianguopai.com/thumb/image/20160701/182206f1011e72df2769d7c1bd843b45a92a53_200_200.jpg"; //缩略图
//$url = "http://img.dev.qianguopai.com/attached/image/20160701/182206f1011e72df2769d7c1bd843b45a92a53_w_h.jpg";//原图
//$url = "http";
//$url = "http://img.dev.qianguopai.com/attached/image/20160701/182206f1011e72df2769d7c1bd843b45a92a53_200_200.jpg"; //缩略图

$imgUrl = \CjsSupport\Img\Url::get($url, 100, 100);

echo $imgUrl . PHP_EOL;