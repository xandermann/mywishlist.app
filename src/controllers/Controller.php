<?php

namespace wishlist\controllers;

abstract class Controller {

	protected $app;

	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}

}
