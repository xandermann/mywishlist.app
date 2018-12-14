<?php

namespace wishlist\controllers;

use wishlist\classes\Validator;

abstract class Controller {

	protected $app;
	protected $validator;

	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
		$this->validator = new Validator;
	}

}
