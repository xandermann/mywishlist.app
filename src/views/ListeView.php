<?php

namespace wishlist\views;

use wishlist\views\View;

class ListeView extends View {

    private function index() {
        $this->content .= '<ul>';
        foreach ($this->var as $v)
            $this->content .= "<li><a href='{$this->app->urlFor('liste.show', ['id' => $v->no])}'>{$v->titre}</a></li>";
        $this->content .= '</ul>';
    }

    private function create() {
        $this->content = "
		<h2>Creer une liste</h2>

		<form action='{$this->app->urlFor('liste.store')}' method='POST'>
		Titre: <input type='text' name='titre'>
        Description: <input type='text' name='description'>
        Token: <input type='text' name='token'>
        Expiration: <input type='text' name='expiration'>
        User_id: <input type='text' name='user_id'>

		<input type='hidden' name='_METHOD' value='POST' />

		<button>Valide</button>
		</form>
		";
    }

    private function show() {
        $this->content = "<h2>{$this->var->titre}</h2>";
    }

    private function edit() {
        $this->content = "
		<h2>Editer la liste {$this->var->no}:</h2>

		<form action='{$this->app->urlFor('liste.update', ['id' => $this->var->no])}' method='POST'>
		Liste ID: <input type='text' name='liste_id' value='{$this->var->liste_id}'>

		Titre: <input type='text' name='titre' value='{$this->var->titre}'>
		Descr: <input type='text' name='description' value='{$this->var->descr}'>
		token: <input type='text' name='token' value='{$this->var->token}'>
		expi: <input type='text' name='expiration' value='{$this->var->expiration}'>
		user_id: <input type='text' name='user_id' value='{$this->var->user_id}'>

		<input type='hidden' name='_METHOD' value='PUT' />

		<button>Valide</button>
		</form>

		<hr>

		<h2>Ou alors le supprimer:</h2>

		<form action='{$this->app->urlFor('liste.destroy', ['id' => $this->var->no])}' method='POST'>

		<input type='hidden' name='id' value='{$this->var->no}'>

		<input type='hidden' name='_METHOD' value='DELETE' />

		<button>Valide</button>
		</form>
		";
    }


    public function render($view) {

        switch($view) {
            case 'index':
                $this->index();
                break;

            case 'create':
                $this->create();
                break;

            case 'show':
                $this->show();
                break;

            case 'edit':
                $this->edit();
                break;
        }

        $this->html();
    }

}
