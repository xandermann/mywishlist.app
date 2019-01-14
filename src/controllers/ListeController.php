<?php

namespace wishlist\controllers;

use wishlist\models\Liste;
use wishlist\models\Messageliste;
use wishlist\controllers\Controller;
use wishlist\models\User;
use wishlist\views\ListeView;
use wishlist\classes\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use wishlist\views\PageView;
use wishlist\classes\Authentification as Auth;
use wishlist\classes\NotFound;



class ListeController extends Controller {

    public function index() {
        $userId = Auth::get('id');

        $liste = Liste::where('user_id', $userId)->get();

        $view = new ListeView($liste);
        $view->render('index');

    }

    public function publique() {
        $liste = Liste::whereNotNull('token')->where('estPublique', 1)->get();

        $view = new ListeView($liste);
        $view->render('publique');

    }

    public function create() {
        if(Auth::check()) {
          $view = new ListeView;
          $view->render('create');
        } else {
          $this->app->redirect($this->app->urlFor("index"));
        }
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
        try {
            $liste = Liste::findOrFail($id);

            if(Auth::check()){
              $view = new ListeView($liste);
              $view->render('show');
            } else {
              $this->notFound();
            }
        } catch(ModelNotFoundException $e) {
            $this->notFound();
        }


    }

    public function showPublic($token) {
        try {
            $liste = Liste::where('token', $token)->firstOrFail();

            $view = new ListeView($liste);
            $view->render('showPublic');
        } catch(ModelNotFoundException $e) {
            $this->notFound();
        }
    }

    public function edit($id) {
        try {
            $liste = Liste::findOrFail($id);
            $view = new ListeView($liste);
            $view->render('edit');
        } catch(ModelNotFoundException $e) {
            $this->notFound();
        }

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
        //
        try {
            $liste = Liste::findOrFail($datas['no']);

            // On genere un token si ce n'est pas encore fait
            $this->createToken($liste);

            $liste->update(['estPublique' => 1]);

            $this->app->redirect($this->app->urlFor('liste.edit', ['id' => $liste->no]));

        } catch(ModelNotFoundException $e) {
            $this->notFound();
        }
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

        try {
            $liste = Liste::findOrFail($datas['no']);

            $this->createToken($liste);

            $this->app->redirect($this->app->urlFor('liste.showPublic', ['token' => $liste->token]));
        } catch(ModelNotFoundException $e) {
            $this->notFound();
        }
    }

    public function destroy($id) {
        Liste::destroy($id);
        $this->app->redirect($this->app->urlFor('liste.index'));
    }



    public function showmessage($id){
        try {

            $mess = Messageliste::where('liste_id', $id)->get();

            $no = Liste::select('user_id')->where('no',$id)->first();

            $nom = User::where('id',$no);

            $array = [$mess,$nom];
            $view = new ListeView($array);
            $view->render('showPublic');
        } catch(ModelNotFoundException $e) {
            $view = new PageView;
            $view->render('notFound');
        }
    }

    public function createmessage() {
        if(Auth::check()) {
            $view = new ListeView();
            $view->render('createmessage');
        } else {
            echo "casse";
            //$this->app->redirect($this->app->urlFor("index"));
        }


    }

    public function messagestore(){
        $validator = new Validator;

        $datas = $validator([
            'message' => $validator::STRING,

        ], 'liste.createmessage');

        //$datas['user_id'] = 1; // TODO


        // Donnees inserees
        $liste = Messageliste::create($datas);

        $this->app->redirect($this->app->urlFor('liste.publique'));
    }
}
