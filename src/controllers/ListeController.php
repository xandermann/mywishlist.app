<?php

namespace wishlist\controllers;

use wishlist\models\Liste;
use wishlist\controllers\Controller;
use wishlist\views\ListeView;
use wishlist\classes\Validator;

class ListeController extends Controller {
    public function index() {
        $liste = Liste::whereNotNull('token')->get();

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


        // Donnees inserees
        Liste::create($datas);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function show($id) {
        //$liste = Liste::findOrFail($id);
        $liste = Liste::findOrFail($id);
        $view = new ListeView($liste);
        $view->render('show');
    }

    public function showPublic($token) {
        //$liste = Liste::findOrFail($id);
        $liste = Liste::where('token', $token)->firstOrFail();
        $view = new ListeView($liste);
        $view->render('showPublic');
    }

    public function edit($id) {
        $liste = Liste::findOrFail($id);
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

    public function setPublic() {

        $validator = new Validator;

        $datas = $validator([
            'no' => $validator::INT
        ], 'liste.edit');

        $liste = Liste::findOrFail($datas['no']);

        // Generation du token
        // On genere un token, tant qu'il y a un token qui existe deja, alors on regenere
        $token;
        do {
            $token = bin2hex(random_bytes(11));
        } while(Liste::where('token', $token)->first());

        //$token est maintenant unique
        $liste->update(['token' => $token]);

        $this->app->redirect($this->app->urlFor('liste.showPublic', ['token' => $token]));
    }

    public function destroy($id) {
        Liste::destroy($id);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }
}