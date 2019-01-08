<?php

namespace wishlist\controllers;

use wishlist\models\Item;
use wishlist\models\Image;
use wishlist\views\ItemView;
use wishlist\views\PageView;
use wishlist\classes\Validator;
use wishlist\models\Liste;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Slim\Slim as App;


class ItemController extends Controller {
	/*
	public function index() {
		$items = Item::all();

		$view = new ItemView($items);
		$view->render('index');
	}
	*/

	public function create($id) {

		// Si la liste existe, ok, sinon 404
		try {
			$liste = Liste::findOrFail($id);
			$view = new ItemView($liste);
			$view->render('create');
		} catch(ModelNotFoundException $e) {
			$this->notFound();
		}


	}

	public function store() {


		$token = $this->app->request->params('listToken');

		try {
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
			$this->app->redirect($this->app->urlFor('liste.show', ['id' => $liste->no]));


		} catch(ModelNotFoundException $e) {
			$this->notFound();
		}


	}

	public function show($id) {
		try {
			$item = Item::findOrFail($id);

			$view = new ItemView($item);
			$view->render('show');
		} catch(ModelNotFoundException $e){
			$this->notFound();
		}


	}

	public function edit($id) {
		try {
			$item = Item::findOrFail($id);

			$view = new ItemView($item);
			$view->render('edit');
		} catch(ModelNotFoundException $e) {
			$this->notFound();
		}

	}

	public function update($id) {
		$liste_id = $this->app->request->put('liste_id');
		$nom = $this->app->request->put('nom');
		$descr = $this->app->request->put('descr');
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
		try {
			Item::findOrFail($id)->update($safeDatas);
			$this->app->redirect($this->app->urlFor('item.index'));
		} catch(ModelNotFoundException $e) {
			$this->notFound();
		}


	}

	public function destroy($id) {
		Item::destroy($id);
		$this->app->redirect($this->app->urlFor('item.index'));
	}

	public function addImage($id){
		$request=App::getInstance()->request();
		$files=$request->getUploadedFiles();

		$uploaded=$files['img'];

		if($uploaded->getError()===UPLOAD_ERR_OK){
			$basename=$_FILES['img']['name'];
			$imgPath='../../public/img_item/';
			$image=new Image();
			$image->path=$basename;
			$image->save();

			DB::table('decris')->insert(['idImage' => $image->idImage , 'nomItem' => $id]);

			move_uploaded_file($_FILES['img']['tmp_name'],$imgPath.$basename);
		}
	}

	public function deleteImage($id,$idImage){

	}
}
