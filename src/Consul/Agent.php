<?php
namespace CjsSupport\Consul;

/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2021/8/14
 * Time: 15:01
 * 服务注册与发现
 */
class Agent extends RegisterConterBase
{

    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    // 注册服务，发起put请求
    public function registerService($serviceInfo = [], $options = []) {
        $options['params'] = \CjsSupport\json_encode($serviceInfo);
        if(empty($options['headers'])) {
            $options['headers'] = ['Content-Type: application/json'];
        }
        $url = $this->getRegisterCenterHost() . '/v1/agent/service/register';
        $token = $this->getConsulToken();
        if($token) {
            $url .= "?token=" . $token;
            // X-Consul-Token
        }
        return $this->client->put($url, $options);
    }

    // 注销服务
    public function deregisterService($serviceId)
    {
        $token = $this->getConsulToken();
        $url = $this->getRegisterCenterHost() . '/v1/agent/service/deregister/'.$serviceId;
        if($token) {
            $url .= "?token=" . $token;
        }
        return $this->client->put($url);
    }

    // 发现服务，获取服务信息
    public function findService($serviceId) {
        static $cacheData = [];
        $token = $this->getConsulToken();
        $key = md5($serviceId . $token);
        if(isset($cacheData[$key])) {
            return $cacheData[$key];
        }
        $url = $this->getRegisterCenterHost() . '/v1/agent/service/' . $serviceId;
        if($token) {
            $url .= "?token=" . $token;
        }
        $res = $this->client->get($url);
        if(empty($res['code'])){
           $cacheData[$key] = $res;
        }
        return $res;
    }
    // 仅获取服务地址
    public function findServiceAddress($serviceId) {
        $address = "";
        $res = $this->findService($serviceId);
        if(empty($res["code"])) {
            $tmpData = json_decode($res["data"], true);
            $address = trim($tmpData['Address'], "/");
        }
        return $address;
    }

}
