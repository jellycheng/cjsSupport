<?php
namespace CjsSupport\Img;
/**
 * 拼接图片url
 */
class Url {

    /**
     * 把千果的原图图片url地址,拼接指定的缩略图地址
     * @param string $img 原图url
     * @param null $w 宽
     * @param null $h 高
     * @return mixed|string
     */
    public static function get($img = '', $w = null, $h = null) {
        $imgUrl = '';
        if(!$img) {
            return $imgUrl;
        }
        //是千果的域名
        if($w && $h && preg_match('/^https?:\/\/[^\/]+(qianguopai\.com)(.*)/i', $img)) {
            $imgUrl = str_replace(array('/attached/', '_w_h'), array('/thumb/', '_'.$w.'_'.$h), $img);
        } else {
            $imgUrl = $img;
        }
        return $imgUrl;
    }

}