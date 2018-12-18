<?php

namespace wishlist\controllers;

use wishlist\views\AuthView;
use wishlist\classes\Authentification as Auth;
use wishlist\classes\AuthException;

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

		// Si 'mot de passe' et 'confirmation du mot de passe' different, alors erreur
		if($datas['password'] != $datas['password_confirm']) {
			$this->app->redirect($this->app->urlFor('auth.signup'));
		}

		try {
			Auth::createUser($datas['user'], $datas['password']);
		} catch(AuthException $e) {
			// Erreur insertion, existe deja
			$this->app->redirect($this->app->urlFor('auth.signup'));
		}

		$this->app->redirect($this->app->urlFor('index'));
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