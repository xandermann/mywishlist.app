<?php

namespace wishlist\views;

use wishlist\views\View;

class ItemView extends View {

	private function index() {
		$this->content .= '<ul>';
		foreach ($this->var as $v)
			$this->content .= "<li><a href='{$this->app->urlFor('item.show', ['id' => $v->id])}'>{$v->nom}</a></li>";
		$this->content .= '</ul>';
	}

	private function create() {
		$this->content = "
		<h1>Creer un item</h1>

		<form action='{$this->app->urlFor('item.store')}' method='POST'>
		Liste ID: <input type='text' name='liste_id'>
		Nom: <input type='text' name='nom'>
		Descr: <input type='text' name='descr'>
		Img: <input type='file' name='img'>
		URL: <input type='text' name='url'>
		Tarif (en €): <input type='number' name='tarif'>

		<input type='hidden' name='_METHOD' value='POST' />

		<button>Valide</button>
		</form>
		";
	}

	private function show() {
		$this->content = "<h1>{$this->var->nom}</h1>";
	}

	private function edit() {
		$this->content = "
		<h1>Editer l'item {$this->var->id}:</h1>

		<form action='{$this->app->urlFor('item.update', ['id' => $this->var->id])}' method='POST'>
		Liste ID: <input type='text' name='liste_id' value='{$this->var->liste_id}'>
		Nom: <input type='text' name='nom' value='{$this->var->nom}'>
		Descr: <input type='text' name='descr' value='{$this->var->descr}'>
		Img: <input type='text' name='img' value='{$this->var->img}'>
		URL: <input type='text' name='url' value='{$this->var->url}'>
		Tarif: <input type='text' name='tarif' value='{$this->var->tarif}'>

		<input type='hidden' name='_METHOD' value='PUT' />

		<button>Valide</button>
		</form>

		<hr>

		<h2>Ou alors le supprimer:</h2>

		<form action='{$this->app->urlFor('item.destroy', ['id' => $this->var->id])}' method='POST'>

		<input type='hidden' name='id' value='{$this->var->id}'>

		<input type='hidden' name='_METHOD' value='DELETE' />

		<button>Valide</button>
		</form>
		";
	}


	public function render() {

		switch($this->view) {
			case 'index':
			$this->index();
			break;

			case 'create':
			$this->create();
			break;

			case 'show':
			$this->show();
			break;

			case 'edit':
			$this->edit();
			break;
		}

		$this->html();
	}

}
