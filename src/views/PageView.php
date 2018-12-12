<?php

namespace wishlist\views;

use wishlist\views\View;

class PageView extends View {

    public function render($view) {

        switch($view) {
            case 'index':
                $this->content .= "<div><h1>Information</h1><p>dhgcbfxbdxfchbcgnhfcncffn</p></div>";
                $this->content .= "<div><form action='{}' method='POST'>
	User: <input type='text' name='user'>
	Password: <input type='password' name='password'>

	<input type='hidden' name='_METHOD' value='POST' />

	<button>Connection</button>
</form></div>";
                break;


            case '404':
                $this->content = "<h1>Erreur 404</h1>";
        }

        $this->html();
    }

}