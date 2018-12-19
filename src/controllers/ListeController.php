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
            'titre' => $validator::STRING,
            'description' => $validator::STRING,
            'expiration' => $validator::STRING,//<== Voir groupe
        ], 'liste.create');

        $datas['user_id'] = 1; // TODO


        // Generation du token
        // On genere un token, tant qu'il y a un token qui existe deja, alors on regenere
        $token;
        $i = 0;
        do {
            $token = md5($datas['user_id'] . $datas['titre'] . $datas['description'] . $datas['expiration'] . $i);
            $i++;
        } while(Liste::where('token', $token)->first());

        $datas['token'] = $token;

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
        $liste = Liste::where('token', $id)->firstOrFail();
        $view = new ListeView($liste);
        $view->render('edit');
    }

    public function update($id) {

        $validator = new Validator;
        $datas = $validator([
            'titre' => $validator::STRING,
            'description' => $validator::STRING,
            'expiration' => $validator::STRING,//<== Voir groupe
        ], 'liste.edit');


        // Donnees inserees
        Liste::where('token', $id)->update($datas);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function destroy($id) {
        Liste::destroy($id);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }
}