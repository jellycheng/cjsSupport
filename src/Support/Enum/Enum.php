<?php
namespace CjsSupport\Enum;

abstract class Enum implements \ArrayAccess
{
    protected $enums; //['常量名'=>'对应值', ]

    public function __construct()
    {
        $this->enums = (new \ReflectionClass($this))->getConstants();
    }

    public static function getInstance()
    {
        return new static;
    }

    public static function valid($val)
    {
        $self = static::getInstance();
        return in_array($val, array_values($self->getEnums()));
    }

    public static function toString()
    {
        $self = static::getInstance();
        return implode(",", $self->getEnums());
    }

    public static function toArray()
    {
        $self = static::getInstance();
        return $self->getEnums();
    }

    public function getEnums()
    {
        return $this->enums;
    }

    public function allConstantsName() {
        if($this->enums) {
            return array_keys($this->enums);
        } else {
            return [];
        }
    }

    public function allConstantsValue() {
        if($this->enums) {
            return array_values($this->enums);
        } else {
            return [];
        }
    }

    public function offsetSet($offset, $value)
    {
        if (!is_null($offset)) {
            $this->enums[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->enums[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->enums[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->enums[$offset]) ? $this->enums[$offset] : null;
    }

}
