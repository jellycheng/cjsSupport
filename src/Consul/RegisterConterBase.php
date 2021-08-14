<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2021/8/14
 * Time: 15:50
 */

namespace CjsSupport\Consul;


abstract class RegisterConterBase
{
    // 注册中心地址
    protected $_register_center_host = "http://127.0.0.1:8500";
    // 注册中心token
    protected $_consul_token = "";

    public function getRegisterCenterHost()
    {
        return $this->_register_center_host;
    }

    public function setRegisterCenterHost($register_center_host)
    {
        $this->_register_center_host = rtrim($register_center_host, "/");
    }

    public function getConsulToken()
    {
        return $this->_consul_token;
    }

    public function setConsulToken($consul_token)
    {
        $this->_consul_token = $consul_token;
    }


}

