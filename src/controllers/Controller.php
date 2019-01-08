<?php

namespace wishlist\controllers;

use wishlist\classes\Validator;
use wishlist\views\PageView;

abstract class Controller {

	protected $app;

	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}

	public function notFound() {
		http_response_code(404);
		$view = new PageView;
		$view->render('notFound');
		die;
	}

}
