<?php

namespace wishlist\views;

use wishlist\views\View;

class AuthView extends View {

	private function signUp() {
		$this->content .= "<h1>Inscription</h1>";

		$this->content .= "<form method='post' action='{$this->app->urlFor('auth.signup')}'>
		<input type='text' name='user' placeholder='User'>
		<input type='password' name='password' placeholder='password'>
		<input type='password' name='password_confirm' placeholder='password_confirm'>
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
