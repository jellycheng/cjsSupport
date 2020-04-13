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
	
	public static function has($param, $methodType = 'auto') {
        if(!$methodType || $methodType == 'auto') {
            $methodType = getRequestMethod(); //请求方式
        } else {
            $methodType = strtoupper($methodType);
        }

        switch($methodType) {
            case 'G':
            case 'GET':
                $val = \CjsSupport\DataManage\GetData::getInstance()->has($param);
                break;
            case 'P':
            case 'POST':
                $val = \CjsSupport\DataManage\PostData::getInstance()->has($param);
                break;
            case 'R':
            case 'REQUEST':
                $val = \CjsSupport\DataManage\RequestData::getInstance()->has($param);
                break;
            case 'S':
            case 'SERVER':
                $val = \CjsSupport\DataManage\ServerData::getInstance()->has($param);
                break;
            case 'E':
            case 'ENV':
                $val = \CjsSupport\DataManage\EnvData::getInstance()->has($param);
                break;
            case 'C':
            case 'COOKIE':
                $val = \CjsSupport\DataManage\CookieData::getInstance()->has($param);
                break;
            case 'F':
            case 'FILE':
                $val = \CjsSupport\DataManage\FilesData::getInstance()->has($param);
                break;
            default:
                $val = false;
                break;
        }
        return $val;

    }


    public static function getInstance($methodType = 'auto') {
        if(!$methodType || $methodType == 'auto') {
            $methodType = getRequestMethod(); //请求方式
        } else {
            $methodType = strtoupper($methodType);
        }

        switch($methodType) {
            case 'G':
            case 'GET':
                $val = \CjsSupport\DataManage\GetData::getInstance();
                break;
            case 'P':
            case 'POST':
                $val = \CjsSupport\DataManage\PostData::getInstance();
                break;
            case 'R':
            case 'REQUEST':
                $val = \CjsSupport\DataManage\RequestData::getInstance();
                break;
            case 'S':
            case 'SERVER':
                $val = \CjsSupport\DataManage\ServerData::getInstance();
                break;
            case 'E':
            case 'ENV':
                $val = \CjsSupport\DataManage\EnvData::getInstance();
                break;
            case 'C':
            case 'COOKIE':
                $val = \CjsSupport\DataManage\CookieData::getInstance();
                break;
            case 'F':
            case 'FILE':
                $val = \CjsSupport\DataManage\FilesData::getInstance();
                break;
            default:
                $val = \CjsSupport\DataManage\EmptyData::getInstance();
                break;
        }
        return $val;

    }


}
