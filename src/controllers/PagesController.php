<?php

namespace wishlist\controllers;

use wishlist\controllers\Controller;
use wishlist\views\PageView;

class PagesController extends Controller {

	public function index() {
		$view = new PageView(null, 'index');
		$view->render();
	}

	public function _404() {
		$view = new PageView(null, '404');
		$view->render();
	}

}