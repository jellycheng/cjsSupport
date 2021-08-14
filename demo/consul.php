<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2021/8/14
 * Time: 15:53
 */

require_once __DIR__ . "/common.php";

$consulToken = "";
$agentObj = new CjsSupport\Consul\Agent();
$agentObj->setRegisterCenterHost("https://dev-consul-chengjinsheng.xxx.com/");
$agentObj->setConsulToken($consulToken);
$res = $agentObj->findService("mobile-api-dev");
if($res["code"]) {
    echo $res["msg"];
} else {
    var_export($res);
}
echo PHP_EOL;

echo $agentObj->findServiceAddress("mobile-api-dev") . PHP_EOL;

echo $agentObj->findServiceAddress("go-cart-service-dev") . PHP_EOL;


// 注册服务：服务名-环境代号
$serviceInfo = ['name'=>'user-service-dev',
                "address"=>'http://user.chengjinsheng.dev.tgs.com',
                "tags"=>["用户服务"],
                "check"=>[
                    "name"=>"mobile-api-dev",
                    "method"=>"GET",
                    "http"=>"http://user.chengjinsheng.dev.tgs.com/health/index",
                    "interval"=>"10s",
                    "timeout"=>"20s",
                ],
            ];
$res2 = $agentObj->registerService($serviceInfo);
var_export($res2);
echo PHP_EOL;

// 注销服务
//$res3 = $agentObj->deregisterService("user-service-dev");
//var_export($res3);
//echo PHP_EOL;
