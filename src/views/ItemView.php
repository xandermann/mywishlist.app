<?php

namespace wishlist\views;

use wishlist\views\View;

class ItemView extends View {

	public function render() {

		switch($this->view) {
			case 'index':

			$this->content .= "<ul>";

			foreach ($this->variables as $variable)
				$this->content .= "<li>{$variable->nom}</li>";

			$this->content .= "</ul>";

			break;
		}

		$this->html();
	}

}