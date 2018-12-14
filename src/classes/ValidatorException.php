<?php

namespace wishlist\classes;

class ValidatorException extends \Exception {
	private $field;

	public function __construct($field) {
		$this->field = $field;
	}

	public function __get($key) {
		return $this->$key;
	}
}