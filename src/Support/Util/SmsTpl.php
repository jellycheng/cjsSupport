<?php
namespace CjsSupport\Util;
/**
 * 短信模板
 */
class SmsTpl {

    protected static $smsTpl = [
        SmsCode::COMMON_CODE=>[
                            'tpl'=>'您的验证码是{sms_code} ', //短信模板
                            'intro'=>'通用模板1', //模板用途描述
                            ],
        SmsCode::REGISTER_BUY => [
                            'tpl'=>'', //短信模板
                            'intro'=>'app注册买家用户发送验证码', //模板用途描述
                            ],
        SmsCode::LOGIN_BUY =>[
                            'tpl'=>'您的登录验证码为{sms_code}, 在2分钟内有效.如非本人操作,请忽略本短信.',
                            'intro'=>'买家app登录发送验证码',
                            ],
    ];


    /**
     * 设置短信模板
     * @param $key
     * @param $val
     */
    public static function setSmsTpl($key, $val) {


    }

    /**
     * 获取模板
     * @param $key
     */
    public static function getSmsTpl($key) {

    }


    /**
     * 获取短信内容
     * @param $key
     * @param array $context
     */
    public static function getSmsContent($key, $context=[]) {
        $tpl = static::getSmsTpl($key);
        $content = '';



        return $content;
    }

}