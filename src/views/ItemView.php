<?php

namespace wishlist\views;

class ItemView {

	private $item;
	private $view;

	public function __construct($item, $view) {
		$this->item = $item;
		$this->view = $view;
	}

	public function render() {
		switch($this->view) {
			case 'index':
			$content = "Bonjour :)";
			break;
		}

		echo <<<END
Affichier les items ici.
END;
	}

}