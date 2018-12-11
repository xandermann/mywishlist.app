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

			case 'create':
				$this->content = `
<h1>Creer un item</h1>

<form action="{$this->app->urlFor('item.store')}" method="POST">
	Liste ID: <input type="text" name="liste_id">
	Nom: <input type="text" name="nom">
	Descr: <input type="text" name="descr">
	Img: <input type="file" name="img">
	URL: <input type="text" name="url">
	Tarif (en €): <input type="number" name="tarif">

	<input type="hidden" name="_METHOD" value="POST" />

	<button>Valide</button>
</form>
`;
		}

		$this->html();
	}

}