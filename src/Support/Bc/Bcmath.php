<?php
namespace CjsSupport\Bc;
/**
 * https://www.php.net/manual/zh/book.bc.php
 * 任意精度函数
 * User: jelly
 * Date: 2019/6/23
 * Time: 21:37
 */
class Bcmath
{
    protected $defaultScale;
    protected $scale;

    public static function getInstance() {
        static $instance = null;
        if(is_null($instance)) {
            $instance = new static();
            $instance->init();
        }
        return $instance;
    }
    public function init() {
        $scale = ini_get('bcmath.scale');//获取默认配置值，老版本的php可以通过 bcscale(int $scale) 方法修改，但php7.3.6验证已经没有效果了，需要ini_set方法修改
        $this->defaultScale = $scale;
        $this->scale = $scale;
    }

    public function getScale() {
        return $this->scale;
    }

    public function setScale($scale) {
        $scale = intval($scale);
        ini_set('bcmath.scale', $scale);
        $this->scale = $scale;
        return $this;
    }

    //恢复scale原来的值
    public function restoreScale() {
        $this->setScale($this->defaultScale);
        return $this;
    }

    /**
     * @param $left_operand 左操作数
     * @param $right_operand 右操作数
     * @param $op 动作
     * @param $scale 小数点位数
     * @return int|string
     */
    public function calc($left_operand, $right_operand, $op, $scale = null){
        $ret = 0;
        switch($op){
            case 'add': //加
                if(is_null($scale)) {
                    $scale = $this->getScale();
                }
                $ret=bcadd($left_operand, $right_operand, $scale);
                break;
            case 'sub': //相减
                if(is_null($scale)) {
                    $scale = $this->getScale();
                }
                $ret=bcsub($left_operand, $right_operand, $scale);
                break;
            case 'mul':  //相乘
                if(is_null($scale)) {
                    $scale = $this->getScale();
                }
                $ret=bcmul($left_operand, $right_operand, $scale);
                break;
            case 'div': //相除
                if($right_operand!=0){
                    if(is_null($scale)) {
                        $scale = $this->getScale();
                    }
                    $ret=bcdiv($left_operand, $right_operand, $scale);
                }else{
                    $ret = 0;
                }
                break;
            case 'pow': //乘方
                if(is_null($scale)) {
                    $scale = $this->getScale();
                }
                $ret=bcpow($left_operand, $right_operand, $scale);
                break;
            case 'mod': //求余
                if($right_operand!=0){
                    $ret=bcmod($left_operand, $right_operand);
                }else{
                    $ret = 0;
                }
                break;
            case 'sqrt': //二次方根
                if(is_null($scale)) {
                    $scale = $this->getScale();
                }
                if($left_operand>=0){
                    $ret=bcsqrt($left_operand, $scale);
                }else{
                    $ret = 0;
                }
                break;
            case 'comp': //比较两个任意精度的数字, 相等返回0，大于返回1, 小于返回-1
                if(is_null($scale)) {
                    $scale = $this->getScale();
                }
                $ret=bccomp($left_operand, $right_operand, $scale);
                break;
            default:
                throw new \Exception("不支持的bc方法: " . $op);
                break;
        }
        return $ret;
    }

}