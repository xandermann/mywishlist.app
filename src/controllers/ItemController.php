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
        $view = new ItemView(null, 'create');
        $view->render();
	}

	public function store() {
		$app =\Slim\Slim::getInstance() ;

		$liste_id = $app->request->post('liste_id');
		$nom = $app->request->post('nom');
		$descr = $app->request->post('descr');
		$img = $app->request->post('img');
		$url = $app->request->post('url');
		$tarif = $app->request->post('tarif');


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
        $app =\Slim\Slim::getInstance() ;
		$liste_id = $app->request->put('liste_id');
		$nom = $app->request->put('nom');
		$descr = $app->request->put('descr');
		$img = $app->request->put('img');
		$url = $app->request->put('url');
		$tarif = $app->request->put('tarif');


		// Donnees inserees
		Item::findOrFail($id)->update(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		//return $response->withRedirect($this->router->pathFor('item.index'));
	}

	public function destroy($id) {
		Item::destroy($id);
		//return $response->withRedirect($this->router->pathFor('item.index'));
	}
}
