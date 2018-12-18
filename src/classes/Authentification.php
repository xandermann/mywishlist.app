<?php

namespace wishlist\classes;

class Authentification {

	private $authSessionVar;

	public function __construct() {
		$this->authSessionVar = $_SESSION['auth'];
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
	}



}