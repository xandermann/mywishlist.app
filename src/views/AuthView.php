<?php

namespace wishlist\views;

use wishlist\views\View;
use wishlist\classes\Authentification as Auth;

class AuthView extends View {

	private function signUp() {
		$this->content .= "<h1>Inscription</h1>";

		$this->content .= "<form method='post' action='{$this->app->urlFor('auth.signup')}'>
		<input type='text' name='email' placeholder='exemple@domaine.fr'>
		<input type='password' name='password' placeholder='Mot de passe'>
		<input type='password' name='password_confirm' placeholder='Confirmation mot de passe'>
		<input type='submit' value='Valide'>
		</form>";
	}

	private function account() {
		$this->content .= "<article>";
		$this->content .= "<h2>Votre espace connexion " . Auth::get('email') . "</h2>";

		$this->content .= "<hr>";

		$this->content .= "<h3>Voulez-vous modifier des paramètres de votre compte ?</h3>";

		$this->content .= "<form action='{$this->app->urlFor('user.update')}' method='POST'>";
		$this->content .= "<input type='mail' name='email' placeholder='email' value='". Auth::get('email') ."'>";
		$this->content .= "<input type='password' name='password' placeholder='Mot de passe'>";
		$this->content .= "<input type='password' name='password_confirm' placeholder='Condirmation du mot de passe'>";
		$this->content .= "<input type='submit' value='Valider'>";

		$this->content .= "<input type='hidden' name='_METHOD' value='PUT'>";
		$this->content .= "</form>";

		$this->content .= "<hr>";

		$this->content .= "<h3>Voulez-vous supprimer votre compte ?</h3>";
		$this->content .= "<form>";
		$this->content .= "<input type='submit' value='Supprimer'>";
		$this->content .= "</form>";

		$this->content .= "</article>";
	}

	public function render($view) {

		switch($view) {
			case 'signUp':
			$this->signUp();
			break;

			case 'account':
			$this->account();
			break;
		}

		$this->html();
	}

}
