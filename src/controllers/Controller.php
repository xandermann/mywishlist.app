<?php

namespace wishlist\controllers;

use wishlist\classes\Validator;

abstract class Controller {

	protected $app;

	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}

}
