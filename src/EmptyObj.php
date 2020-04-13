<?php
namespace CjsSupport;

class EmptyObj {

	public static function create()
	{
		return new static();
	}

	public function get()
	{
		return new \stdClass;
	}

	public static function g()
	{
		return new \stdClass();

	}
}