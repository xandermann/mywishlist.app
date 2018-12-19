<?php

namespace wishlist\controllers;

use wishlist\models\Item;
use wishlist\views\ItemView;
use wishlist\classes\Validator;
use wishlist\models\Liste;

class ItemController extends Controller {
	/*
	public function index() {
		$items = Item::all();

		$view = new ItemView($items);
		$view->render('index');
	}
	*/

	public function create($listToken) {

		// Si la liste existe, ok, sinon 404
		$liste = Liste::where('token', $listToken)->firstOrFail();

		$view = new ItemView($liste);
		$view->render('create');
	}

	public function store() {


		$token = $this->app->request->params('listToken');
		$liste = Liste::where('token', $token)->firstOrFail(); // Si token pas OK, erreur 404

		$validator = new Validator;
		$datas = $validator([
			'nom' => $validator::STRING,
			'descr' => $validator::STRING,
			'tarif' => $validator::FLOAT,
		], 'item.create', ['listToken' => $token]);

		$datas['liste_id'] = $liste->no;

		// Donnees inserees
		Item::create($datas);
		$this->app->redirect($this->app->urlFor('liste.edit', ['id' => $token]));
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

		$validator = new Validator;
		$safeDatas = $validator([
			'liste_id' => $validator::STRING,
			'nom' => $validator::STRING,
			'descr' => $validator::STRING,
			//'img' => $this->validator::STRING, 	//<== Voir groupe
			'url' => $validator::URL,
			'tarif' => $validator::FLOAT,
		], 'item.create');


		// Donnees inserees
		Item::findOrFail($id)->update($safeDatas);
		$this->app->redirect($this->app->urlFor('item.index'));
	}

	public function destroy($id) {
		Item::destroy($id);
		$this->app->redirect($this->app->urlFor('item.index'));
	}
}
