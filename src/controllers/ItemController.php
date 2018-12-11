<?php

namespace wishlist\controllers;

use wishlist\models\Item;
use wishlist\views\ItemView;

class ItemController extends Controller {
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
		$liste_id = $this->app->request->post('liste_id');
		$nom = $this->app->request->post('nom');
		$descr = $this->app->request->post('descr');
		$img = $this->app->request->post('img');
		$url = $this->app->request->post('url');
		$tarif = $this->app->request->post('tarif');


		// Donnees inserees
		Item::create(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		$this->app->redirect($this->app->urlFor('item.index'));
	}

	public function show($id) {
		$item = Item::findOrFail($id);

		$view = new ItemView($item, 'show');
		$view->render();
	}

	public function edit($id) {
		$item = Item::findOrFail($id);

		$view = new ItemView($item, 'edit');
		$view->render();
	}

	public function update($id) {
		$liste_id = $this->app->request->put('liste_id');
		$nom = $this->app->request->put('nom');
		$descr = $this->app->request->put('descr');
		$img = $this->app->request->put('img');
		$url = $this->app->request->put('url');
		$tarif = $this->app->request->put('tarif');


		// Donnees inserees
		Item::findOrFail($id)->update(compact('liste_id', 'nom', 'descr', 'img', 'url', 'tarif'));
		$this->app->redirect($this->app->urlFor('item.index'));
	}

	public function destroy($id) {
		Item::destroy($id);
		$this->app->redirect($this->app->urlFor('item.index'));
	}
}
