<?php

namespace wishlist\controllers;

use wishlist\models\Liste;

class ListeController {
    public function index() {
        $liste = Liste::all();

        $view = new ListeView($liste, 'index');
        $view->render();

    }

    public function create() {
        $view = new ListeView(null, 'create');
        $view->render();
    }

    public function store() {

        $app =\Slim\Slim::getInstance() ;

        $titre = $app->request->getParam('titre');
        $description = $app->request->getParam('descr');
        $token = $app->request->getParam('token');
        $expiration = $app->request->getParam('expiration');
        $user_id = $app->request->getParam('user_id');



        // Donnees inserees
        Liste::create(compact('user_id','titre', 'description',  'expiration','token' ));
        //return $response->withRedirect($this->router->pathFor('liste.index'));
    }

    public function show($id) {
        $liste = Liste::findOrFail($id);
        $view = new ListeView($liste, 'show');
        $view->render();
    }

    public function edit($id) {
        $liste = Liste::findOrFail($id);
        $view = new ListeView($liste, 'edit');
        $view->render();
    }

    public function update($id) {
        $app =\Slim\Slim::getInstance() ;
        $titre = $app->request->getParam('titre');
        $description = $app->request->getParam('descr');
        $token = $app->request->getParam('token');
        $expiration = $app->request->getParam('expiration');
        $user_id = $app->request->getParam('user_id');


        // Donnees inserees
        Liste::findOrFail($id)->update(compact('user_id','titre', 'description',  'expiration','token'));
        //return $response->withRedirect($this->router->pathFor('liste.index'));
    }

    public function destroy($id) {
        Liste::destroy($id);
        //return $response->withRedirect($this->router->pathFor('liste.index'));
    }
}