<?php

namespace wishlist\controllers;

use wishlist\models\Liste;
use wishlist\controllers\Controller;
use wishlist\views\ListeView;
use wishlist\classes\Validator;

class ListeController extends Controller {
    public function index() {
        $liste = Liste::all();

        $view = new ListeView($liste);
        $view->render('index');

    }

    public function create() {
        $view = new ListeView;
        $view->render('create');
    }

    public function store() {
        $validator = new Validator;

        $datas = $validator([
            'user_id' => $validator::INT,
            'titre' => $validator::STRING,
            'description' => $validator::STRING,
            'expiration' => $validator::STRING,//<== Voir groupe
            'token' => $validator::STRING,
        ], 'liste.create');

        // Donnees inserees
        Liste::create($datas);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function show($id) {
        //$liste = Liste::findOrFail($id);
        $liste = Liste::where('token', $id)->firstOrFail();
        $view = new ListeView($liste);
        $view->render('show');
    }

    public function edit($id) {
        $liste = Liste::findOrFail($id);
        $view = new ListeView($liste);
        $view->render('edit');
    }

    public function update($id) {

        $validator = new Validator;
        $datas = $validator([
            'user_id' => $validator::INT,
            'titre' => $validator::STRING,
            'description' => $validator::STRING,
            'expiration' => $validator::STRING,//<== Voir groupe
            'token' => $validator::STRING
        ], 'liste.edit');


        // Donnees inserees
        Liste::findOrFail($id)->update($datas);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function destroy($id) {
        Liste::destroy($id);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }
}