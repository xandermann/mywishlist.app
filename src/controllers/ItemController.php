<?php

namespace wishlist\controllers;

use wishlist\models\Item;
use wishlist\views\ItemView;

class ItemController extends Controller {
	public function index() {
		$items = Item::all();

		$view = new ItemView($items);
		$view->render('index');
	}

	public function create() {
        $view = new ItemView;
        $view->render('create');
	}

	public function store() {

		$safeDatas = ($this->validator)([
			'liste_id' => $this->validator::STRING,
			'nom' => $this->validator::STRING,
			'descr' => $this->validator::STRING,
			//'img' => $this->validator::STRING, 	//<== Voir groupe
			'url' => $this->validator::URL,
			'tarif' => $this->validator::FLOAT,
		], 'item.create');

		// Donnees inserees
		Item::create($safeDatas);
		$this->app->redirect($this->app->urlFor('item.index'));
	}

	public function show($id) {
		$item = Item::findOrFail($id);

		$view = new ItemView($item);
		$view->render('show');
	}

	public function edit($id) {
		$item = Item::findOrFail($id);

		$view = new ItemView($item);
		$view->render('edit');
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
