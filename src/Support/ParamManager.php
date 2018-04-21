<?php
namespace CjsSupport;


class ParamManager{


    public static function get($param, $default = '', $methodType = 'auto') {
        if(!$methodType || $methodType == 'auto') {
            $methodType = getRequestMethod(); //请求方式
        } else {
            $methodType = strtoupper($methodType);
        }

        switch($methodType) {
            case 'G':
            case 'GET':
                $val = \CjsSupport\DataManage\GetData::getInstance()->get($param, $default);
                break;
            case 'P':
            case 'POST':
                $val = \CjsSupport\DataManage\PostData::getInstance()->get($param, $default);
                break;
            case 'R':
            case 'REQUEST':
                $val = \CjsSupport\DataManage\RequestData::getInstance()->get($param, $default);
                break;
            case 'S':
            case 'SERVER':
                $val = \CjsSupport\DataManage\ServerData::getInstance()->get($param, $default);
                break;
            case 'E':
            case 'ENV':
                $val = \CjsSupport\DataManage\EnvData::getInstance()->get($param, $default);
                break;
            case 'C':
            case 'COOKIE':
                $val = \CjsSupport\DataManage\CookieData::getInstance()->get($param, $default);
                break;

            case 'F':
            case 'FILE':
                $val = \CjsSupport\DataManage\FilesData::getInstance()->get($param, $default);
                break;
            default:
                $val = $default instanceof \Closure ? $default() : $default;
                break;
        }
        return $val;

    }


}
