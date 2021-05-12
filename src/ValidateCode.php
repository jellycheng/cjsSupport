<?php
namespace CjsSupport;

//图片验证码类
class ValidateCode {

    protected $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//随机因子
    protected $code;//验证码
    protected $codelen = 4;//验证码长度
    protected $width = 130;//宽度
    protected $height = 50;//高度
    protected $img;//图形资源句柄
    protected $font;//指定的字体
    protected $fontsize = 20;//指定字体大小
    protected $fontcolor;//指定字体颜色

    //构造方法初始化
    public function __construct($width = 130, $hight = 30, $fontsize = 20, $codelen = 4)
    {
        $this->width = $width;
        $this->hight = $hight;
        $this->fontsize = $fontsize;
        $this->codelen = $codelen;
        $this->font = dirname(__FILE__) . '/font/elephant.ttf';//注意字体路径要写对，否则显示不了图片
    }

    // 外部传入图片验证码
    public function setCode($code)
    {
        if(empty($code)) {
            return $this;
        }
        $this->codelen = mb_strlen($code);
        $this->code = $code;
        return $this;
    }

    //生成随机码
    private function createCode()
    {
        $_len = mb_strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->code .= $this->charset[mt_rand(0, $_len)];
        }
    }

    //生成背景
    private function createBg()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    //生成文字
    private function createFont()
    {
        $_x = $this->width / $this->codelen;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $_x * $i + mt_rand(1, 5), $this->height / 1.4, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }

    //生成线条、雪花
    private function createLine()
    {
        //线条
        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }
        //雪花
        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
        }
    }

    //输出
    private function outPut()
    {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    //对外生成
    public function doimg()
    {
        $this->createBg();
        if(empty($this->code)){
           $this->createCode(); 
        }
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    //获取验证码
    public function getCode()
    {
        return strtolower($this->code);
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    public function getFont()
    {
        return $this->font;
    }

    public function setFont($font)
    {
        $this->font = $font;
        return $this;
    }

}

