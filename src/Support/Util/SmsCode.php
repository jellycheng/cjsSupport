<?php
namespace CjsSupport\Util;
/**
 * 短信业务代号
 * 字母常量=>代号
 */
class SmsCode {

    const COMMON_CODE = 99000; //通用短信模板代号
    const REGISTER_BUY = 10001;//app注册买家用户发送验证码
    const LOGIN_BUY = 10002; //买家app登录发送验证码

}