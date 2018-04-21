<?php

require __DIR__ . '/common.php';


$data = CjsSupport\DataManage\CssData::getInstance()->getData();
var_export($data);
echo PHP_EOL;

CjsSupport\DataManage\CssData::getInstance()->set('', 'hi0.css');
CjsSupport\DataManage\CssData::getInstance()->set('', 'hi1.css');
CjsSupport\DataManage\CssData::getInstance()->set('4', 'hi4.css');
CjsSupport\DataManage\CssData::getInstance()->set('user.0', 'user.css');
CjsSupport\DataManage\CssData::getInstance()->set('user.list', 'user_list.css');
echo CjsSupport\DataManage\CssData::getInstance()->get('user.list') . PHP_EOL;
CjsSupport\DataManage\CssData::getInstance()->remove('user.0')->remove('1');
echo CjsSupport\DataManage\CssData::getInstance()->get('user.list.not', 'not exists!') . PHP_EOL;
CjsSupport\DataManage\CssData::getInstance()->set('user.not', 'not exists!');

CjsSupport\DataManage\JsData::getInstance()->set('', 'js0.js');
CjsSupport\DataManage\JsData::getInstance()->set('', 'hi1.js');
CjsSupport\DataManage\JsData::getInstance()->set('4', 'hi4.js');
CjsSupport\DataManage\JsData::getInstance()->set('user.0', 'user.js');
CjsSupport\DataManage\JsData::getInstance()->set('user.list', 'user_list.js');

var_dump(CjsSupport\DataManage\JsData::getInstance()->has(0));
var_dump(CjsSupport\DataManage\JsData::getInstance()->has('user.list'));
$jsdata  = CjsSupport\DataManage\JsData::getInstance()->getData();
$cssdata = CjsSupport\DataManage\CssData::getInstance()->getData();
var_export($jsdata);
echo PHP_EOL;
var_export($cssdata);
echo PHP_EOL;

echo CjsSupport\DataManage\SeoData::getInstance()->get('title') . PHP_EOL;
CjsSupport\DataManage\SeoData::getInstance()->setTitle('标题了')->setKeywords('关键字')->setDescription('描述');
echo CjsSupport\DataManage\SeoData::getInstance()->get('title') . PHP_EOL;
var_export(CjsSupport\DataManage\SeoData::getInstance()->getData());
echo PHP_EOL;

$seoObj = CjsSupport\DataManage\SeoData::getInstance();
echo "title: " . $seoObj['title'] . PHP_EOL;
$seoObj['title'] = "new title";
echo "title: " . $seoObj['title'] . PHP_EOL;
var_dump(isset($seoObj['title']));
unset($seoObj['title']);
echo "title: " . $seoObj['title'] . PHP_EOL;
var_dump(isset($seoObj['title']));