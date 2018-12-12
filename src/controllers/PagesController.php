<?php

namespace wishlist\controllers;

use wishlist\controllers\Controller;
use wishlist\views\PageView;

class PagesController extends Controller {

	public function index() {
		$view = new PageView;
		$view->render('index');
	}

	public function notFound() {
		$view = new PageView;
		$view->render('notFound');
	}

}