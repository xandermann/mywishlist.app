<?php

namespace wishlist\views;

use wishlist\views\View;
use wishlist\classes\Authentification as Auth;

class UserView extends View {

	private function creator() {

		$this->content .= "<article>";
		$this->content .= "<h2>Liste des createurs</h2>";

		$this->content .= "<ul>";

		foreach($this->var as $createur)
			$this->content .= "<li>$createur->email</li>";

		$this->content .= "</ul>";

		$this->content .= "</article>";
	}


	public function render($view) {

		switch($view) {
			case 'creator':
			$this->creator();
			break;

			case 'creator':
			$this->creator();
			break;
		}

		$this->html();
	}

}
