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



/*========================================*/
/* PAGES */
/*========================================*/
use wishlist\controllers\PagesController;

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

$app->get('/item', function () {
    $controller = new ItemController();
    $controller->index();
})->name('item.index');

// Liste des routes
$app->get('/item/create', function () {
    $controller = new ItemController();
    $controller->create();
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




/*========================================*/
/* LISTES */
/*========================================*/
use wishlist\controllers\ListeController;

$app->get('/liste', function () {
    $controller = new ListeController();
    $controller->index();
})->name('liste.index');

// Liste des routes
$app->get('/liste/create', function () {
    $controller = new ListeController();
    $controller->create();
})->name('liste.create');

$app->post('/liste', function () {
    $controller = new ListeController();
    $controller->store();
})->name('liste.store');

$app->get('/liste/:id', function ($id) {
    $controller = new ListeController();
    $controller->show($id);
})->name('liste.show')->conditions(['id' => '[0-9]+']);

$app->get('/liste/:id/edit', function ($id) {
    $controller = new ListeController();
    $controller->edit($id);
})->name('liste.edit')->conditions(['id' => '[0-9]+']);

$app->put('/liste/:id', function ($id) {
    $controller = new ItemController();
    $controller->update($id);
})->name('liste.update')->conditions(['id' => '[0-9]+']);

$app->delete('/liste/:id', function ($id) {
    $controller = new ItemController();
    $controller->destroy($id);
})->name('liste.destroy')->conditions(['id' => '[0-9]+']);




use wishlist\classes\Authentification;
use wishlist\controllers\AuthController;
// Routes quand l'utilisateur N'EST PAS connecte
$app->group('/auth', function() use ($app) {
    $app->get('/inscription', function() {
        $controller = new AuthController;
        $controller->signUp();
    });

    $app->get('/connexion', function() {
        $controller = new AuthController;
        $controller->signIn();
    });
});


// Routes quand l'utilisateur EST connecte
$app->group('/auth', function() use ($app) {
    $app->get('/deconnexion', function() {
        $controller = new AuthController;
        $controller->signUp();
    });
});








$app->run();
