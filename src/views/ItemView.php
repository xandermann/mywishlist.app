<?php

namespace wishlist\views;

use wishlist\views\View;
use wishlist\classes\ImageTypeLoader;

class ItemView extends View {

	/*
	private function index() {
		$this->content .= '<ul>';
		foreach ($this->var as $v)
			$this->content .= "<li><a href='{$this->app->urlFor('item.show', ['id' => $v->id])}'>{$v->nom}</a></li>";
		$this->content .= '</ul>';
	}
	*/

	private function create() {
		$this->content = "
		<h2>Creer un item</h2>

		<form action='{$this->app->urlFor('item.store')}' method='POST'>
		Nom: <input type='text' name='nom'>
		Descr: <input type='text' name='descr'>
		Tarif (en €): <input type='number' name='tarif'>

		<input type='hidden' name='listToken' value='{$this->var->token}'>

		<input type='hidden' name='_METHOD' value='POST' />

		<input type='submit' value='Valide'>
		</form>
		";
	}

	private function show() {
		$this->content .= "<h2>{$this->var->nom}</h2>";
		$this->content .= "<p>{$this->var->descr}</p>";
		$this->content .= "<img src='../img_item/{$this->var->img}'>";
	}

	private function edit() {
		$accepted_types=ImageTypeLoader::types();
		$this->content = "
		<h2>Editer l'item {$this->var->id}:</h2>

		<form action='{$this->app->urlFor('item.update', ['id' => $this->var->id])}' method='POST'>
		Liste ID: <input type='text' name='liste_id' value='{$this->var->liste_id}'>
		Nom: <input type='text' name='nom' value='{$this->var->nom}'>
		Descr: <input type='text' name='descr' value='{$this->var->descr}'>
		URL: <input type='text' name='url' value='{$this->var->url}'>
		Tarif: <input type='text' name='tarif' value='{$this->var->tarif}'>

		<input type='hidden' name='_METHOD' value='PUT' />

		<input type='submit' value='Valide'>
		</form>

		<h2>ajouter des images à l'item {$this->var->id}:</h2>

		<form action='{$this->app->urlFor('item.images',['id' => $this->var->id])}' enctype='multipart/form-data' method='POST'>
		Img: <input type='file' name='img' value='{$this->var->img} accept='{$accepted_types}'>
		</form>

		<hr>

		<h2>Ou alors le supprimer:</h2>

		<form action='{$this->app->urlFor('item.destroy', ['id' => $this->var->id])}' method='POST'>

		<input type='hidden' name='id' value='{$this->var->id}'>

		<input type='hidden' name='_METHOD' value='DELETE' />

		<input type='submit' value='Valide'>
		</form>
		";
	}


	public function render($view) {

		switch($view) {
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
