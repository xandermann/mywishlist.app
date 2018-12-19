<?php

namespace wishlist\views;

use wishlist\views\View;

class PageView extends View {

    public function render($view) {

        switch($view) {
            case 'index':
            /*
                $this->content .= "<div><h2>Connexion</h2></div>";
                $this->content .= "<div><form action='{}' method='POST'>
	<input type='text' placeholder='Pseudo' name='user'>
	<input type='password' placeholder='Password' name='password'>

	<input type='hidden' name='_METHOD' value='POST' />

	<button>Connection</button>
</form></div>";
*/
                $this->content .= "<h2>MyWishlist.app</h2>";

                $this->content .= "<ul>";
                $this->content .= "<li><a href='{$this->app->urlFor('liste.index')}'>Voir les listes publiques</a></li>";
                $this->content .= "<li><a href='{$this->app->urlFor('liste.create')}'>Créer une liste</a></li>";
                $this->content .= "</ul>";

                break;


            case 'notFound':
                $this->content = "<h2>Erreur 404</h2>";
        }

        $this->html();
    }

}
