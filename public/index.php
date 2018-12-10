<?php

require_once "../vendor/autoload.php";

use \Slim\Slim;
use \wishlist\CC;

$app = new \Slim\Slim();


use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$db->addConnection(parse_ini_file('../src/config/db.ini'));
$db->setAsGlobal();
$db->bootEloquent();



$app->get('/', function () {
	echo "Page d'accueil (TODO)";
});





// Gestion des items
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
})->name('item.show');

$app->get('/item/:id/edit', function ($id) {
    $controller = new ItemController();
    $controller->edit($id);
})->name('item.edit');

$app->put('/item/:id', function ($id) {
    $controller = new ItemController();
    $controller->update($id);
})->name('item.update');

$app->delete('/item/:id', function ($id) {
    $controller = new ItemController();
    $controller->destroy($id);
})->name('item.destroy');


/*
// Gestion des listes
use \wishlist\controllers\ListeController;
$app->get('/liste', ListeController::class . ':index')->setName('liste.index');
$app->get('/liste/create', ListeController::class . ':create')->setName('liste.create');
$app->post('/liste', ListeController::class . ':store')->setName('liste.store');
$app->get('/liste/{id:[0-9]+}', ListeController::class . ':show')->setName('liste.show');
$app->get('/liste/{id:[0-9]+}/edit', ListeController::class . ':edit')->setName('liste.edit');
$app->put('/liste/{id:[0-9]+}', ListeController::class . ':update')->setName('liste.update');
$app->delete('/liste/{id:[0-9]+}', ListeController::class . ':destroy')->setName('liste.destroy');
*/










$app->run();