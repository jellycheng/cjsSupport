<?php
namespace CjsSupport\Util;
/**
 * 短信业务代号
 * 字母常量=>代号
 * 暂定代号长度为5位,
 * 前2位表示终端类型 如 10 表示买家app，20表示商家app，30表示快递员app
 * 后3位表示业务模块，如001 表用户注册发送短信，002用户登录，003找回密码，004修改登录密码，005修改支付密码
 */
class SmsCode
{
    const COMMON_TEST = 99001; //test code
    const COMMON_CODE = 99000; //通用短信模板代号



    const REGISTER_BUY = 10001;//app注册买家用户发送验证码
    const LOGIN_BUY = 10002; //买家app登录发送验证码
    const FORGET_PWD_BUY = 10003; //买家app找回密码发送验证码
    const RESET_PWD_BUY = 10004; //	买家app重置支付密码发送验证码



    const REGISTER_MERCHANT=20001;//商家app注册发送验证码
    const LOGIN__MERCHANT = 20002;	//商家app登录发送验证码
    const FORGET_PWD_MERCHANT=20003;//	商家app找回密码发送验证码
    const REST_PWD_MERCHANT=20004;	//商家app重置支付密码发送验证码



    const REGISTER_COURIER=30001;//	快递员app注册发送验证码
    const LOGIN_COURIER=30002;//	快递员app登录发送验证码
    const FORGET_PWD_COURIER=30003;//	快递员app找回密码发送验证码
    const RESET_PWD_COURIER=30004;//	快递员app重置支付密码发送验证码

}