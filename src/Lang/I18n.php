<?php
namespace CjsSupport\Lang;

class I18n{

    protected $lang   = []; //语言配置
    protected $langType = 'en';//语言代号
    protected $lang_dir = __DIR__ . '/i18n/';
    protected $langConfig = [];


    protected function __construct()
    {
    }

    public static function getInstance() {
        static $instance = null;
        if(!$instance) {
            $instance = new static();
        }
        return $instance;
    }

    public function setLang($langType = '') {
        if(!$langType) {
            $langType = $this->getType();
        }

        $langType = str_replace(array('/','\\','..','.'),'', $langType);
        //兼容旧版本
        if($langType == 'zh_CN') $langType = 'zh-CN';
        if($langType == 'zh_TW') $langType = 'zh-TW';

        $langFile = $this->lang_dir . $langType . '/main.php';

        if(file_exists($langFile)){
            $this->lang = include($langFile);
        }
    }

    public function getLang() {
        return $this->lang;
    }

    public function setLangConfig($file = '') {
        if($file && file_exists($file)) {
            $this->langConfig = include $file;
        } elseif(!$file) {
            $this->langConfig = include $this->lang_dir . 'lang.php';
        }
    }

    public function getLangConfig() {
        return $this->langConfig;
    }


    public function defaultLang() {
        $lang  = $this->getType();
        $arr   = $this->langConfig;
        $langs = array();
        foreach ($arr as $key => $value) {
            $langs[$key] = $key;
        }
        $langs['zh'] = 'zh-CN';	//增加大小写对应关系
        $langs['zh-tw'] = 'zh-TW';

        $acceptLanguage = array();
        if(!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            $httpLang = $this->getType();
        }else{
            $httpLang = str_replace("_","-",strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));
        }
        preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',$httpLang,$matches,PREG_SET_ORDER);
        foreach ($matches as $match) {
            $acceptLanguage[$match[1]] = (isset($match[3]) ? $match[3] : 1);
        }
        arsort($acceptLanguage);
        foreach ($acceptLanguage as $key => $q) {
            if (isset($langs[$key])) {
                $lang = $langs[$key];break;
            }
            $key = preg_replace('~-.*~','', $key);
            if (!isset($acceptLanguage[$key]) && isset($langs[$key])) {
                $lang = $langs[$key];break;
            }
        }
        return $lang;
    }

    public function getAll(){
        return $this->lang;
    }

    public function getType(){
        return $this->langType;
    }


    public function get($key){
        if(!isset($this->lang[$key])){
            return $key;
        }
        if (func_num_args() == 1) {
            return $this->lang[$key];
        } else {
            $args = func_get_args();
            array_shift($args);
            return vsprintf($this->lang[$key], $args);
        }
    }

    /**
     * 添加多语言;
     * @param array $args = ['key'=>value]
     */
    public function set($array){
        if(!is_array($array)) return;
        foreach ($array as $key => $value) {
            $this->lang[$key] = $value;
        }
    }

}
