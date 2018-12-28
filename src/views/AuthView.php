<?php

namespace wishlist\views;

use wishlist\views\View;

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

	public function render($view) {

		switch($view) {
			case 'signUp':
			$this->signUp();
			break;
		}

		$this->html();
	}

}
