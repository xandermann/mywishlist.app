<?php

namespace wishlist\controllers;

use wishlist\models\User;
use wishlist\classes\Validator;
use wishlist\classes\Authentification as Auth;

class UserController extends Controller
{

	public function update() {
		$validator = new Validator;

		$datas = $validator([
			'email' => $validator::EMAIL,
			'password' => $validator::STRING,
			'password_confirm' => $validator::STRING,
		], 'auth.account');

		if($datas['password'] !== $datas['password_confirm']) {
			$this->app->redirect($this->app->urlFor('auth.account') . '?error=passwordDiff');
		}

		$accountID = Auth::get('id');

		User::find($accountID)->update([
			'email' => $datas['email'],
			'password' => $datas['password']
		]);

		Auth::loadProfile($datas['email']);

		$this->app->redirect($this->app->urlFor('auth.account') . '?success');
	}

}