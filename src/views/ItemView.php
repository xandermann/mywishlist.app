<?php

namespace wishlist\views;

use wishlist\views\View;

class ItemView extends View {

	public function render() {
		switch($this->view) {
			case 'index':
			$content = "Contenu de la page ici";
			break;
		}

		$this->html($content);
	}

}