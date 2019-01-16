<?php

namespace wishlist\controllers;

use wishlist\models\Item;
use wishlist\models\Image;
use wishlist\views\ItemView;
use wishlist\views\PageView;
use wishlist\classes\Validator;
use wishlist\models\Liste;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Facades\Facade;
use Slim\Slim as App;
use wishlist\classes\ValidatorException;


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

		$validator = new Validator;
		$datasID = $validator([
			'liste_id' => $validator::INT
		], 'index');


		try {

			// On valide les donnees de base
			$validator = new Validator;
			$datas = $validator([
				'nom' => $validator::STRING,
				'descr' => $validator::STRING,
				'tarif' => $validator::FLOAT,
			], 'item.create', ['id' => $datasID['liste_id']]);

			// On ajoute le numero de la liste
			$datas['liste_id'] = $datasID['liste_id'];

			$validatorURL = new Validator;

			// Si existe, on verifie l'URL
			if($this->app->request->params('url') != null || $this->app->request->params('url') != '') {
				$urlValidator = $validatorURL([
					'url' => $validator::URL
				], 'item.create', ['id' => $datasID['liste_id']]);
			} else {
				// Sinon l'URL prend une valeur par defaut
				$urlValidator['url'] = null;
			}

			// On ajoute au donnees que l'on va inserer
			$datas['url'] = $urlValidator['url'];
			$datas['url'] = null;


			// Donnees inserees
			Item::create($datas);
			$this->app->redirect($this->app->urlFor('liste.publique'));


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
		try {

			$v = new Validator;
			$datasID = $v([
				'id' => $v::INT,
			], 'index');

			// On valide les donnees de base
			$validator = new Validator;
			$datas = $validator([
				'id' => $validator::INT,
				'liste_id' => $validator::INT,
				'nom' => $validator::STRING,
				'descr' => $validator::STRING,
				'tarif' => $validator::FLOAT,
			], 'item.edit', ['id' => $datasID['id']]);



			// On ajoute le numero de la liste
			$validatorURL = new Validator;

			// Si existe, on verifie l'URL
			if($this->app->request->params('url') != null || $this->app->request->params('url') != '') {
				$urlValidator = $validatorURL([
					'url' => $validator::URL
				], 'item.create', ['id' => $datasID['id']]);
			} else {
				// Sinon l'URL prend une valeur par defaut
				$urlValidator['url'] = null;
			}

			// On ajoute au donnees que l'on va inserer
			$datas['url'] = $urlValidator['url'];


			$datas['url'] = null;

			// Donnees inserees
			Item::findOrFail($datasID['id'])->update($datas);
			$this->app->redirect($this->app->urlFor('item.show', ['id' => $datasID['id']]));


		} catch(ModelNotFoundException $e) {
			$this->notFound();
		}
	}

	public function destroy($id) {
		Item::destroy($id);
		$this->app->redirect($this->app->urlFor('liste.index'));
	}

	public function addImage($id){
		$request=App::getInstance()->request();
		//$files=$request->getUploadedFiles();

		//$uploaded=$files['img'];

		if(isset($_FILES['img'])){
			$basename=$_FILES['img']['name'];
			$imgPath='img_item/';
			$image=new Image();
			$image->path=$basename;
			$image->save();
			//here error
			DB::table('decris')->insert(['image_idImage' => $image->idImage , 'item_id' => $id]);

			move_uploaded_file($_FILES['img']['tmp_name'],$imgPath.$basename);
		}

		$this->app->redirect($this->app->urlFor('liste.show', ['id' => $id]));
	}

	public function deleteImage($id,$idImage){
		DB::table('decris')->where(
			['idImage','=',$idImage],
			['nomItem','=',$id]
		)->delete();

		$count=DB::table('decris')->where('image_idImage','=',$idImage)->count();

		if($count==0){
			$img=Image::find('idImage');
			$path='../../public/img_item/'.$img->path;
			$img->delete();
			unlink($path);
		}

		$this->app->redirect($this->app->urlFor('liste.show', ['id' => $id]));
	}
}
