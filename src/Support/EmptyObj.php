<?php
namespace CjsSupport;

class EmptyObj {

	public function get() {
		return new \stdClass;
	}

	public static function g() {
		return new \stdClass();

	}
}