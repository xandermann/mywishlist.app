<?php

namespace wishlist\controllers;


use wishlist\models\Item;

class ItemController {
	public function index() {
		$items = Item::all();
		return $this->view($response, 'item/index.php', 'Item index', compact('items'));
	}

	public function create() {
		return $this->view($response, 'item/create.php', 'Creer un item');
	}

	public function store() {

		$liste_id = $request->getParam('liste_id');
		$nom = $request->getParam('nom');
		$descr = $request->getParam('descr');
		$img = $request->getParam('img');
		$url = $request->getParam('url');
		$tarif = $request->getParam('tarif');


		// Donnees inserees
		Item::create(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		return $response->withRedirect($this->router->pathFor('item.index'));
	}

	public function show() {
		$item = Item::findOrFail($args['id']);
		return $this->view($response, 'item/show.php', "Afficher l'item $item->id", compact('item'));
	}

	public function edit() {
		$item = Item::findOrFail($args['id']);
		return $this->view($response, 'item/edit.php', "Editer un item", compact('item'));
	}

	public function update() {
		$liste_id = $request->getParam('liste_id');
		$nom = $request->getParam('nom');
		$descr = $request->getParam('descr');
		$img = $request->getParam('img');
		$url = $request->getParam('url');
		$tarif = $request->getParam('tarif');


		// Donnees inserees
		Item::findOrFail($args['id'])->update(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		return $response->withRedirect($this->router->pathFor('item.index'));
	}

	public function destroy() {
		Item::destroy($args['id']);
		return $response->withRedirect($this->router->pathFor('item.index'));
	}
}
