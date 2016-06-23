<?php
namespace CjsSupport;


class ResponseFormat {


    /**
     * @param int $code
     * @param string $msg
     * @param string $data
     * @return array|\stdClass|string
     */
    public static function response($code = 0, $msg = 'OK', $data = '') {
        if(!$data) {
            $data = \CjsSupport\EmptyObj::g();
        }
        $code = intval($code);
        $data = array(
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        );
        return $data;
    }

    /**
     * 成功格式
     * @param string $data
     * @param string $msg
     * @return array|\stdClass|string
     */
    public static function success($data = '', $msg = 'OK') {
       return self::response(0, $msg, $data);

    }

    /**
     * 错误格式
     * @param $code
     * @param $msg
     * @param string $data
     * @return array|\stdClass|string
     */
    public static function error($code, $msg, $data = '') {
        if(!$code) {
            $code = 100000;
        }
        return self::response($code, $msg, $data);

    }

}
