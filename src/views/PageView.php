<?php

namespace wishlist\views;

use wishlist\views\View;
use wishlist\classes\Authentification as Auth;

class PageView extends View {

    public function render($view) {

        switch($view) {
            case 'index':
/*
                $this->content .= "<article><h2>MyWishlist.app</h2>";

                $this->content .= "<ul>";
                $this->content .= "<li><a href='{$this->app->urlFor('liste.index')}'>Voir les listes publiques</a></li>";
                $this->content .= "<li><a href='{$this->app->urlFor('liste.create')}'>Créer une liste</a></li>";
                $this->content .= "</ul></article>";
*/

                $this->content .= "<article><h2>Information</h2>";
                $this->content .= "<p>Sur ce site vous pouvez faire vos listes de noel ....<br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore natus accusamus consectetur dolores eum repudiandae laborum iste voluptas earum, expedita officia voluptatum velit amet ducimus deserunt sequi quaerat ullam necessitatibus reprehenderit doloremque, dignissimos hic et aut optio ipsam. Inventore saepe rerum fugit quos. Explicabo aperiam ullam eum cupiditate cum alias.</p></article>";



                if(!Auth::check()) {
                    $this->content .= "<article><div><h2>Connexion</h2></div>";
                    $this->content .= "<div><form action='{$this->app->urlFor('auth.signin')}' method='POST'>
                    <input type='text' placeholder='Email' name='email'>
                    <input type='password' placeholder='Password' name='password'>

                    <input type='hidden' name='_METHOD' value='POST' />

                    <input type='submit' value='Connection'>
                    </form></div>

                    <hr>

                    <h2>Inscription</h2>
                    <a href='{$this->app->urlFor('auth.signup')}'>Inscription</a></article>";
                } else {
                    $this->content .= "<aside><p>Felicitation vous êtes connecté <strong>" . Auth::get('email') . "</strong> ! Accedez à votre espace compte en cliquant <a href='{$this->app->urlFor('auth.account')}'>ici</a></p>

                    <div><a href='{$this->app->urlFor('auth.signout')}'>Se déconnecter</a></div>
                    </aside>";
                }

                break;


                case 'notFound':
                $this->content = "<h2>Erreur 404</h2>";
            }

            $this->html();
        }

    }
