<?php

namespace wishlist\controllers;

use wishlist\models\Liste;

class ListeController {
    public function index() {
        $listes = Liste::all();
        return $this->view($response, 'liste/index.php', 'liste index', compact('listes'));
    }

    public function create() {
        return $this->view($response, 'liste/create.php', 'Creer une liste');
    }

    public function store() {

        $titre = $request->getParam('titre');
        $description = $request->getParam('descr');
        $token = $request->getParam('token');
        $expiration = $request->getParam('expiration');
        $user_id = $request->getParam('user_id');



        // Donnees inserees
        Liste::create(compact('user_id','titre', 'description',  'expiration','token' ));
        return $response->withRedirect($this->router->pathFor('liste.index'));
    }

    public function show() {
        $liste = Liste::findOrFail($args['id']);
        return $this->view($response, 'liste/show.php', "Afficher la liste $liste->no", compact('liste'));
    }

    public function edit() {
        $liste = Liste::findOrFail($args['id']);
        return $this->view($response, 'liste/edit.php', "Editer une liste", compact('liste'));
    }

    public function update() {
        $titre = $request->getParam('titre');
        $description = $request->getParam('descr');
        $token = $request->getParam('token');
        $expiration = $request->getParam('expiration');
        $user_id = $request->getParam('user_id');


        // Donnees inserees
        Liste::findOrFail($args['id'])->update(compact('user_id','titre', 'description',  'expiration','token'));
        return $response->withRedirect($this->router->pathFor('liste.index'));
    }

    public function destroy() {
        Liste::destroy($args['id']);
        return $response->withRedirect($this->router->pathFor('liste.index'));
    }
}