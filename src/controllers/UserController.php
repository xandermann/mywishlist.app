<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 11/12/2018
 * Time: 11:42
 */


namespace wishlist\controllers;

use wishlist\models\User;

class UserController
{
    public function index()
    {
        $User = User::all();

        $view = new ListeView($User, 'index');
        $view->render();

    }
}