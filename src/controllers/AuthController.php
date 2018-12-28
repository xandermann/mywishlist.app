<?php

namespace wishlist\controllers;

use wishlist\views\AuthView;
use wishlist\classes\Authentification as Auth;
use wishlist\classes\AuthException;
use wishlist\classes\Validator;


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

		$validator = new Validator;

		$datas = $validator([
			'email' => $validator::EMAIL,
			'password' => $validator::STRING,
			'password_confirm' => $validator::STRING,
		], 'auth.signup');

		// Si 'mot de passe' et 'confirmation du mot de passe' different, alors erreur
		if($datas['password'] != $datas['password_confirm']) {
			$this->app->redirect($this->app->urlFor('auth.signup'));
		}

		try {
			Auth::createUser($datas['email'], $datas['password']);
		} catch(AuthException $e) {
			// Erreur insertion, existe deja
			$this->app->redirect($this->app->urlFor('auth.signup') . '?error=utilisateurExisteDeja');
		}

		$this->app->redirect($this->app->urlFor('index'));
	}

	/**
	 * Connexion
	 * => Il n'y a pas de page connexion, nous passons par la page 'index'
	 */
	public function getSignIn() {
	}

	public function postSignIn() {
		$validator = new Validator;

		$datas = $validator([
			'email' => $validator::EMAIL,
			'password' => $validator::STRING,
		], 'index');

		try {
			Auth::authenticate($datas['email'], $datas['password']);
		} catch (AuthException $e) {
			$this->app->redirect($this->app->urlFor('index') . '?error=incorrectPassword');
		}

		Auth::loadProfile($datas['email']);

		$this->app->redirect($this->app->urlFor('index'));
	}

	/**
	 * Deconnexion
	 */
	public function getSignOut() {
		Auth::logOut();
		$this->app->redirect($this->app->urlFor('index'));
	}


	public function getAccount() {
		$view = new AuthView;
		$view->render('account');
	}

}