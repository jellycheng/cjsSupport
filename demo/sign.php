<?php
require __DIR__ . '/common.php';

$body=<<<EOT
{"header":{"account_name":"账号","company_name":"企业名称","email":"员工邮箱","phone":"员工手机号","realname":"员工姓名"},"data":{"account_name":"zhangsan","company_name":"xxx信息技术有限公司","email":"wang.xxx@xxx.com","phone":"18612345678","realname":"王*华"}}
EOT;
$secret = "sdfsdfasdfsdfasdf";
echo CjsSupport\Util\Sign::BodyContentMd5Sign($body, $secret) . PHP_EOL;
