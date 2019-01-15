<?php

namespace wishlist\controllers;

use wishlist\models\User;
use wishlist\models\Liste;
use wishlist\classes\Validator;
use wishlist\classes\Authentification as Auth;
use wishlist\views\UserView;

class UserController extends Controller
{

	public function creator() {

		$createurs = User::whereIn('id', Liste::select('user_id')->where('estPublique', 1))->get();

		$view = new UserView($createurs);
		$view->render('creator');
	}

	/**
	 * Met a jour l'utilisateur courant
	 */
	public function update() {
		$validator = new Validator;

		// Recupere les donnees
		$datas = $validator([
			'password' => $validator::PASSWORD,
			'password_confirm' => $validator::STRING, // => String, nous verifions deja 'password'
		], 'auth.account');

		// Si les mots de passes sont differents
		if($datas['password'] !== $datas['password_confirm']) {
			$this->app->redirect($this->app->urlFor('auth.account') . '?error=passwordDiff');
		}

		// On recupere l'ID
		$accountID = Auth::get('id');

		// On le met à jour
		User::find($accountID)->update([
			'email' => $datas['email'],
			'password' => $datas['password']
		]);

		// On recharge le profil
		Auth::logOut();

		// On redirige
		$this->app->redirect($this->app->urlFor('auth.account') . '?success');
	}


	public function delete() {
		$id = Auth::get('id');

		// Supprime le compte
		User::find($id)->delete();

		// Deconnecte l'utilisateur
		Auth::logOut();

		$this->app->redirect($this->app->urlFor('index') . '?success');
	}

}