<?php
require_once __DIR__ . '/common.php';

$lang = CjsSupport\Lang\I18n::getInstance();
$langType = 'zh-CN';
echo $lang->defaultLang() . PHP_EOL;
$lang->setLang($langType);

var_export($lang->getAll());

echo $lang->get('path_api_select_folder') . PHP_EOL;

echo $lang->get('ymd', 2018, 04, 23) . PHP_EOL;

$lang->setLangConfig();
var_export($lang->getLangConfig());
echo PHP_EOL;
