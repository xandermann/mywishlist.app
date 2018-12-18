<?php

namespace wishlist\controllers;

use wishlist\views\AuthView;
use wishlist\classes\Authentification as Auth;

class AuthController extends Controller {

	/**
	 * Inscripion
	 */
	public function getSignUp() {
		$view = new AuthView;
		$view->render('signUp');
	}

	/**
	 * Inscripion
	 */
	public function postSignUp() {

		$datas = ($this->validator)([
			'user' => $this->validator::STRING,
			'password' => $this->validator::STRING,
			'password_confirm' => $this->validator::STRING,
		], 'auth.signup');

		var_dump($datas);
		die;
	}

	/**
	 * Connexion
	 */
	public function getSignIn() {

	}

	/**
	 * Deconnexion
	 */
	public function signOut() {
		Auth::logOut();
		$this->app->redirect($this->app->urlFor('index'));
	}

}