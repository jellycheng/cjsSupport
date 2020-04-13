<?php
namespace CjsSupport;
/**
 * 表达式
 */
class Expression
{

    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->getValue();
    }

}