<?php
require_once __DIR__ . '/common.php';

//带有emoji表情的字符串
$str = " abc 是不是不能带emoji表情哦🏃 sdf";

echo "   emoji表情： " . $str . PHP_EOL;
echo "处理后的表情： " . \CjsSupport\filterEmoji($str);
echo PHP_EOL;
