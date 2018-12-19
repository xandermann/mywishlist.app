<?php

namespace wishlist\controllers;

use wishlist\models\Liste;
use wishlist\controllers\Controller;
use wishlist\views\ListeView;
use wishlist\classes\Validator;

class ListeController extends Controller {
    public function index() {
        $liste = Liste::whereNotNull('token')->where('estPublique', 1)->get();

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
            'expiration' => $validator::DATE,
        ], 'liste.create');

        $datas['user_id'] = 1; // TODO


        // Donnees inserees
        $liste = Liste::create($datas);

        $this->app->redirect($this->app->urlFor('liste.show', ['id' => $liste->no]));
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
            'expiration' => $validator::DATE,
        ], 'liste.edit');


        // Donnees inserees
        Liste::where('token', $id)->update($datas);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function setPublic() {


        $validator = new Validator;

        $datas = $validator([
            'no' => $validator::INT,
        ], 'liste.index');

        // Passe a 1 la liste
        $liste = Liste::findOrFail($datas['no']);


        // On genere un token si ce n'est pas encore fait
        $this->createToken($liste);

        $liste->update(['estPublique' => 1]);

        $this->app->redirect($this->app->urlFor('liste.edit', ['id' => $liste->no]));
    }

    private function createToken($liste) {
        // Si le token existe deja, ne le genere pas
        if(!$liste->token) {
            // Generation du token
            // On genere un token, tant qu'il y a un token qui existe deja, alors on regenere
            $token;
            do {
                $token = bin2hex(random_bytes(11));
            } while(Liste::where('token', $token)->first());

            //$token est maintenant unique
            $liste->update(['token' => $token]);

        }
    }

    public function generateToken() {

        $validator = new Validator;

        $datas = $validator([
            'no' => $validator::INT
        ], 'liste.index');

        $liste = Liste::findOrFail($datas['no']);

        $this->createToken($liste);

        $this->app->redirect($this->app->urlFor('liste.showPublic', ['token' => $liste->token]));
    }

    public function destroy($id) {
        Liste::destroy($id);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }
}