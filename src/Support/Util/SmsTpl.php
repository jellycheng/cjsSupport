<?php
namespace CjsSupport\Util;
/**
 * 短信模板
 */
class SmsTpl
{

    protected static $smsTpl = [
        'default' => [
            'tpl' => '您的验证码是{sms_code} ', //短信模板
            'intro' => '默认模板', //模板用途描述
        ],
        SmsCode::COMMON_TEST=>[
            'tpl' => '您的验证码是{sms_code} , {username} {nickname}', //短信模板
            'intro' => 'test模板', //模板用途描述
        ],
        SmsCode::COMMON_CODE => [
            'tpl' => '您的验证码是{sms_code} ', //短信模板
            'intro' => '通用模板1', //模板用途描述
        ],
        SmsCode::REGISTER_BUY => [
            'tpl' => '您的注册验证码为{sms_code}, 在2分钟内有效.如非本人操作,请忽略本短信.', //短信模板
            'intro' => 'app注册买家用户发送验证码', //模板用途描述
        ],
        SmsCode::LOGIN_BUY => [
            'tpl' => '您的登录验证码为{sms_code}, 在2分钟内有效.如非本人操作,请忽略本短信.',
            'intro' => '买家app登录发送验证码',
        ],
    ];


    /**
     * 设置短信模板
     * @param $key
     * @param $val
     */
    public static function setSmsTpl($code, $val = array())
    {
        static::$smsTpl[$code] = $val;
    }

    /**
     * 获取模板
     * @param $key
     */
    public static function getSmsTpl($code, $key = 'tpl')
    {
        $smsTpl = static::$smsTpl;
        $tmp = isset($smsTpl[$code]) ? $smsTpl[$code] : $smsTpl['default'];
        if (is_null($key)) {
            return $tmp;
        }
        if (isset($tmp[$key])) {
            return $tmp[$key];
        }
        return $tmp;
    }


    /**
     * 获取短信内容
     * @param $key
     * @param array $context
     */
    public static function getSmsContent($key, $context = [])
    {
        $tpl = static::getSmsTpl($key);
        $content = preg_replace_callback(
            '/{\s*([A-Za-z_\-\.0-9]+)\s*}/',
            function (array $matches) use ($context) {
                $result = '';
                $keyWord = $matches[1];
                if (isset($context[$keyWord])) {
                    $result = $context[$keyWord];
                }
                return $result;
            },
            $tpl
        );

        return $content;
    }

}