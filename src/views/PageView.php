<?php

namespace wishlist\views;

use wishlist\views\View;

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

                $this->content .= "<article><div><h2>Connexion</h2></div>";
                $this->content .= "<div><form action='{}' method='POST'>
	            <input type='text' placeholder='Pseudo' name='user'>
	            <input type='password' placeholder='Password' name='password'>

	            <input type='hidden' name='_METHOD' value='POST' />

	            <input type='submit' value='Connection'>
                </form></div>
                <button>Inscription</button><p>A Faire proprement</p></article>";
                break;


            case 'notFound':
                $this->content = "<h2>Erreur 404</h2>";
        }

        $this->html();
    }

}
