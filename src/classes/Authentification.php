<?php

namespace wishlist\classes;

use wishlist\models\User;
use wishlist\classes\AuthException;


class Authentification {

	private $authSessionVar = "auth";

	/**
	 * Check si l'utilisateur est connecte ou pas
	 */
	public static function check(): bool {
		return false;
		var_dump($this->authSessionVar);
		die;
	}

	public static function logOut() {
		unset($_SESSION[$authSessionVar]);
	}

	public static function authenticate($login, $password): bool {
		// Verifie si l'utilisateur est OK
	}

	public static function loadProfile($login) {
		// Met dans la session l'utilisateur
	}

	public static function checkAccessRights($requiredLevel) {
		// Check si l'utilisateur a un niveau siffisant
		// throw new AuthException;
	}

	public static function createUser($login, $password) {
		// Creer l'utilisateur dans la base de donnee
		// Hash le mot de passe quand inscription avec la base de donnee
		$userAlreadyExists = User::where('email', $login)->first();

		if($userAlreadyExists == null) {
			$pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
			User::create([
				'email' => $login,
				'password' => $pass_hash,
			]);

		} else {
			throw new AuthException();
		}

	}

}