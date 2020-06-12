<?php
require __DIR__ . '/common.php';

//要扫描的目录
$scanDirs = ["/Users/jelly/hdscode/",
            "/data/www/",
            "/data/www/frontend",
            "/data1/www/",
            "/data1/www/frontend",
            ];

foreach ($scanDirs as $scanDir) {
    $gitPullObj = new \CjsSupport\Util\GitPull();
    $gitPullObj->GitPullCode($scanDir);

}

