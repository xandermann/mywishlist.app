<?php

namespace wishlist\controllers;

use wishlist\models\Liste;
use wishlist\controllers\Controller;
use wishlist\views\ListeView;

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
        $titre = $this->app->request->getParam('titre');
        $description = $this->app->request->getParam('descr');
        $token = $this->app->request->getParam('token');
        $expiration = $this->app->request->getParam('expiration');
        $user_id = $this->app->request->getParam('user_id');



        // Donnees inserees
        Liste::create(compact('user_id','titre', 'description',  'expiration','token' ));
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function show($id) {
        $liste = Liste::findOrFail($id);
        $view = new ListeView($liste);
        //$liste->items;
        $view->render('show');
    }

    public function edit($id) {
        $liste = Liste::findOrFail($id);
        $view = new ListeView($liste);
        $view->render('edit');
    }

    public function update($id) {
        $titre = $this->app->request->getParam('titre');
        $description = $this->app->request->getParam('descr');
        $token = $this->app->request->getParam('token');
        $expiration = $this->app->request->getParam('expiration');
        $user_id = $this->app->request->getParam('user_id');


        // Donnees inserees
        Liste::findOrFail($id)->update(compact('user_id','titre', 'description',  'expiration','token'));
        $this->app->redirect($this->app->urlFor('liste.index'));
    }

    public function destroy($id) {
        Liste::destroy($id);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }
}