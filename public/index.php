<?php

session_start();
require_once "../vendor/autoload.php";

use \Slim\Slim;
use \wishlist\CC;

$app = new \Slim\Slim();



use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$db->addConnection(parse_ini_file('../src/config/db.ini'));
$db->setAsGlobal();
$db->bootEloquent();

use wishlist\controllers\PagesController;
use wishlist\classes\Authentification as Auth;



$app->get('/css', function () use ($app) {
    $app->response->headers->set('Content-Type', 'text/css');
    require 'style.css';
})->name('css');

$app->get('/img/:image', function ($image) use ($app) {
    $app->response->headers->set('Content-Type', 'image/jpg');
    try {
      readfile("img_item/$image");
    } catch(Exception $e) {
    }
})->name('img');


/*========================================*/
/* PAGES */
/*========================================*/

$app->get('/', function () {
    $controller = new PagesController;
    $controller->index();
})->name('index');
$app->notFound(function () {
    $controller = new PagesController;
    $controller->notFound();
});




/*========================================*/
/* ITEMS */
/*========================================*/
use wishlist\controllers\ItemController;

/*
// Pas dans le sujet
$app->get('/item', function () {
    $controller = new ItemController();
    $controller->index();
})->name('item.index');
*/

// Liste des routes
$app->get('/item/create/:id', function ($id) {
    $controller = new ItemController();
    $controller->create($id);
})->name('item.create');

$app->post('/item', function () {
    $controller = new ItemController();
    $controller->store();
})->name('item.store');

$app->get('/item/:id', function ($id) {
    $controller = new ItemController();
    $controller->show($id);
})->name('item.show')->conditions(['id' => '[0-9]+']);

$app->get('/item/:id/edit', function ($id) {
    $controller = new ItemController();
    $controller->edit($id);
})->name('item.edit')->conditions(['id' => '[0-9]+']);

$app->put('/item/:id', function ($id) {
    $controller = new ItemController();
    $controller->update($id);
})->name('item.update')->conditions(['id' => '[0-9]+']);

$app->delete('/item/:id', function ($id) {
    $controller = new ItemController();
    $controller->destroy($id);
})->name('item.destroy')->conditions(['id' => '[0-9]+']);

$app->post('/item/:id',function ($id){
    $controller=new ItemController();
    $controller->addImage($id);
})->name('item.images.create')->conditions(['id' => '[0-9]+']);

$app->delete('/item/:id/:idImage',function($id,$idImage){
    $controller=new ItemController();
    $controller->deleteImage($id,$idImage);
})->name('item.images.destroy')->conditions(['id' => '[0-9]+'])->conditions(['idImage' => '[0-9]+']);



/*========================================*/
/* LISTES */
/*========================================*/
use wishlist\controllers\ListeController;

// Affiche les listes DE L'UTILISATEUR

    $app->get('/liste', function () {
        $controller = new ListeController();
        $controller->index();
    })->name('liste.index');



// Affiche les listes publiques
$app->get('/liste/publique', function () {
    $controller = new ListeController();
    $controller->publique();
})->name('liste.publique');

// Liste des routes

//if(Auth::check()){
  $app->get('/liste/create', function () {
      $controller = new ListeController();
      $controller->create();
  })->name('liste.create');
//}

$app->post('/listecreer', function () {

    $controller = new ListeController();
    $controller->store();
})->name('liste.store');


$app->get('/liste/:id', function ($id) {
    $controller = new ListeController();
    $controller->show($id);
})->name('liste.show')->conditions(['id' => '[0-9]+']);

$app->get('/liste/publique/:token', function ($token) {
    $controller = new ListeController();
    $controller->showPublic($token);
})->name('liste.showPublic');


$app->get('/liste/:id/edit', function ($id) {
    $controller = new ListeController();
    $controller->edit($id);
})->name('liste.edit')->conditions(['id' => '[0-9]+']);



$app->put('/liste/:id', function ($id) {
    $controller = new ListeController();
    $controller->update($id);
})->name('liste.update')->conditions(['id' => '[0-9]+']);

$app->put('/liste/mettre/publique', function () {
    $controller = new ListeController();
    $controller->setPublic();
})->name('liste.setPublic');

$app->put('/liste/generer/token', function () {
    $controller = new ListeController();
    $controller->generateToken();
})->name('liste.generateToken');

$app->delete('/liste/:id', function ($id) {
    $controller = new ListeController();
    $controller->destroy($id);
})->name('liste.destroy')->conditions(['id' => '[0-9]+']);

$app->get('/liste/messageliste/:id', function ($id) {
    $controller = new ListeController();
    $controller->showmessage($id);
})->name('liste.showmessage')->conditions(['id' => '[0-9]+']);



$app->get('/liste/createmessage', function () {

    $controller = new ListeController();
    $controller->createmessage();
})->name('liste.createmessage');

$app->post('/liste/messagestore', function () {

    $controller = new ListeController();
    $controller->messagestore();
})->name('liste.messagestore');






use wishlist\controllers\AuthController;
use wishlist\controllers\UserController;

if(!Auth::check()) {
// Routes quand l'utilisateur N'EST PAS connecte
    $app->group('/auth', function() use ($app) {

        $app->get('/inscription', function() {
            $controller = new AuthController;
            $controller->getSignUp();
        })->name('auth.signup');

        $app->post('/inscription', function() {
            $controller = new AuthController;
            $controller->postSignUp();
        });

        $app->get('/connexion', function() {
            $controller = new AuthController;
            $controller->getSignIn();
        })->name('auth.signin');

        $app->post('/connexion', function() {
            $controller = new AuthController;
            $controller->postSignIn();
        });
    });

} else {

    // Routes quand l'utilisateur EST connecte
    $app->group('/auth', function() use ($app) {
        $app->get('/deconnexion', function() {
            $controller = new AuthController;
            $controller->getSignOut();
        })->name('auth.signout');


        $app->get('/compte', function() {
            $controller = new AuthController;
            $controller->getAccount();
        })->name('auth.account');
    });


    $app->put('/user/mettre-a-jour-le-compte', function () {
        $controller = new UserController();
        $controller->update();
    })->name('user.update');

    $app->delete('/user/supprimer-le-compte', function () {
        $controller = new UserController();
        $controller->delete();
    })->name('user.delete');

}



$app->get('/createurs', function() {
        $controller = new UserController();
        $controller->creator();
})->name('user.creator');



$app->run();
