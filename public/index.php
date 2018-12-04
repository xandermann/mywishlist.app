<?php

require_once "../vendor/autoload.php";

use \Slim\Slim;
use \wishlist\CC;

$app = new \Slim\Slim();

$app->get('/', function () {
    CC::cc();
});

$app->run();