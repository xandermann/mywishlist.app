<?php

namespace wishlist\controllers;

use wishlist\models\Item;
use wishlist\views\ItemView;

class ItemController {
	public function index() {
		$items = Item::all();

		$view = new ItemView($items, 'index');
		$view->render();
	}

	public function create() {
		//return $this->view($response, 'item/create.php', 'Creer un item');
	}

	public function store() {

		$liste_id = $app->request->post('liste_id');
		$nom = $request->post('nom');
		$descr = $request->post('descr');
		$img = $request->post('img');
		$url = $request->post('url');
		$tarif = $request->post('tarif');


		// Donnees inserees
		Item::create(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		//return $response->withRedirect($this->router->pathFor('item.index'));
	}

	public function show($id) {
		$item = Item::findOrFail($id);
		//return $this->view($response, 'item/show.php', "Afficher l'item $item->id", compact('item'));
	}

	public function edit($id) {
		$item = Item::findOrFail($id);
		//return $this->view($response, 'item/edit.php', "Editer un item", compact('item'));
	}

	public function update($id) {
		$liste_id = $request->put('liste_id');
		$nom = $request->put('nom');
		$descr = $request->put('descr');
		$img = $request->put('img');
		$url = $request->put('url');
		$tarif = $request->put('tarif');


		// Donnees inserees
		Item::findOrFail($id)->update(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		//return $response->withRedirect($this->router->pathFor('item.index'));
	}

	public function destroy($id) {
		Item::destroy($id);
		//return $response->withRedirect($this->router->pathFor('item.index'));
	}
}
