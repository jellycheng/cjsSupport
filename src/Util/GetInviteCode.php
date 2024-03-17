<?php
namespace CjsSupport\Util;
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2024/3/17
 * Time: 10:28
 * 通过用户ID生成邀请码，最低4位
 */

class GetInviteCode {

    protected $key;
    protected $num;
    public function __construct() {
        $this->key = 'abcdefghjkmnpqrstwxy345678'; // 注意这个key里面不能出现数字9  否则当 求模=0 会重复的
        $this->num = mb_strlen($this->key);
    }

    // 通过用户id生成唯一邀请码
    public function enCode($user_id) {
        $code = ''; // 邀请码
        while ($user_id > 0) {
            $mod = $user_id % $this->num;
            $user_id = ($user_id - $mod) / $this->num;
            $code = $this->key[$mod] . $code;
        }
        $code = str_pad($code, 4, '9', STR_PAD_LEFT); // 不足用9补充
        return $code;
    }

    // 邀请码获取用户id
    function deCode($code) {
        if (strrpos($code, '9') !== false){
            $code = mb_substr($code, strrpos($code, '9') + 1);
        }
        $len = strlen($code);
        $code = strrev($code);
        $user_id = 0;
        for ($i = 0; $i < $len; $i++){
            $user_id += strpos($this->key, $code[$i]) * pow($this->num, $i);
        }
        return $user_id;
    }


}


