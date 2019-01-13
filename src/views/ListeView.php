<?php

namespace wishlist\views;

use wishlist\views\View;
use wishlist\classes\Authentification as Auth;

class ListeView extends View {

    private function index() {

        $this->content .= '<article>';
        $this->content .= '<h2>Vos listes sont ici</h2>';

        $this->content .= '<ul>';
        foreach ($this->var as $v)
            $this->content .= "<li><a href='{$this->app->urlFor('liste.showPublic', ['token' => $v->token])}'>{$v->titre}</a></li>";
        $this->content .= '</ul>';
        $this->content .= '</article>';
    }

    private function publique() {

        $this->content .= '<article><h2>Listes public</h2>';

        $this->content .= '<ul>';
        foreach ($this->var as $v)
            $this->content .= "<li><a href='{$this->app->urlFor('liste.showPublic', ['token' => $v->token])}'>{$v->titre}</a></li>";
        $this->content .= '</ul></article>';
    }

    private function create() {

        $this->content = "
        <article><h2>Creer une liste</h2>

        <form action='{$this->app->urlFor('liste.store')}' method='POST'>
        Titre: <input type='text' name='titre'>
        Description: <input type='text' name='description'>
        Expiration: <input type='date' name='expiration'>

        <input type='hidden' name='_METHOD' value='POST' />

        <input type='submit' value='Valide'>

        </form>

        </article>
        ";

    }

    private function show() {
        $this->content .= "<article><h2>{$this->var->titre}</h2>";

        if(Auth::check()) {
        $this->content .= "<a href='{$this->app->urlFor('liste.edit', ['id' => $this->var->no])}'>Editer la liste</a>";
        }

        $this->content .= "<ul>";
        foreach($this->var->items as $item) {
            $this->content .= "<p>{$item->nom}</p>";
            $this->content .= "<p>{$item->descr}</p>";
            $this->content .= "<img src='../../img_item/{$item->img}'>";
            $this->content .= "<hr>";
        }
        $this->content .= "</ul></article>";

        $this->afficheMessage();


    }

    private function showPublic() {
        $this->content .= '<article>';

        $this->content .= "<p>Vous voyez une liste partagée: {$this->app->urlFor('liste.showPublic', ['token' => $this->var->token])}</p>";

        $this->content .= "<h2>{$this->var->titre}</h2>";

        if(Auth::check()){
          $this->content .= "<a href='{$this->app->urlFor('liste.edit', ['id' => $this->var->no])}'>Editer la liste</a>";
        }

        $this->content .= "<ul>";
        foreach($this->var->items as $item) {
            $this->content .= "<p>{$item->nom}</p>";
            $this->content .= "<p>{$item->descr}</p>";
            $this->content .= "<img src='../../img_item/{$item->img}'>";
            $this->content .= "<hr>";
        }
        $this->content .= "</ul>";
        $this->afficheMessage();
        $this->content .= '</article>';

    }

    private function afficheMessage(){
        $this->content .= "<article><ul>";
        $x = 1 ;
        foreach($this->var->messagesliste as $m) {
                $this->content .= "<li>$x {$this->var->user->email} : {$m->message}</li>";
                $x++;
        }
        $this->content .= "</ul>";
        if(Auth::check()){
          $this->content .= "<a href='{$this->app->urlFor('liste.createmessage', ['id' => $this->var->no])}'>Ajouter un message</a>";
        }else{
            $this->content .= 'vous devez vous connecter';
        }
        $this->content .= '</article>';
    }

    private function createmessage(){/////////////////////////////////////////////c'est ici
        $this->content = "

        <h2>Ajouter un message</h2>

        <form action='{$this->app->urlFor('liste.messagestore')}' method='POST'>
        Message : <input type='text' name='message'>

        <input type='hidden' name='_METHOD' value='POST' />

        <input type='submit' value='Valide'>

        </form></article>";
    }

    private function edit() {

        $this->content = "
        <article><h2>Editer la liste \"{$this->var->titre}\":</h2>

        <a href='{$this->app->urlFor('item.create', ['id' => $this->var->no])}'>Ajouter un item</a>

        <hr>

        <h2>Rendre la liste publique</h2>

        <form action='{$this->app->urlFor('liste.setPublic')}' method='post'>
        <input type='hidden' name='no' value='{$this->var->no}'>

        <input type='hidden' name='_METHOD' value='PUT'>

        <input type='submit' value='Rendre la liste publique'>
        </form>

        <hr>

        <h2>Recuperer le token</h2>

        <form action='{$this->app->urlFor('liste.generateToken')}' method='post'>
        <input type='hidden' name='no' value='{$this->var->no}'>

        <input type='hidden' name='_METHOD' value='PUT'>

        <input type='submit' value='Recuperer le lien (via token)'>
        </form>

        <hr>

        <form action='{$this->app->urlFor('liste.update', ['id' => $this->var->token])}' method='POST'>

        Titre: <input type='text' name='titre' value='{$this->var->titre}'>
        Descr: <input type='text' name='description' value='{$this->var->description}'>
        expi: <input type='date' name='expiration' value='{$this->var->expiration}'>

        <input type='hidden' name='_METHOD' value='PUT' />

        <input type='submit' value='Valide'>
        </form>

        <hr>

        <h2>Ou alors la supprimer:</h2>

        <form action='{$this->app->urlFor('liste.destroy', ['id' => $this->var->no])}' method='POST'>

        <input type='hidden' name='id' value='{$this->var->no}'>

        <input type='hidden' name='_METHOD' value='DELETE' />

        <input type='submit' value='Valide'>
        </form></article>
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

            case 'showPublic':
            $this->showPublic();
            break;

            case 'publique':
            $this->publique();
            break;

            case 'createmessage':
            $this->createmessage();/////////////////////////////////////////////c'est ici
            break;

        }

        $this->html();
    }

}
