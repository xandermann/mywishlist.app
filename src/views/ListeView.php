<?php

namespace wishlist\views;

use wishlist\views\View;

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

        $this->content .= '<article><h2>Vos listes sont ici</h2>';

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

        <p>A faire correctement pour le bouton + peut etre mettre a droite la liste des items et on a juste a les cochez pour les ajouter a la liste comme a l'acceuil avec connection pour le visuel</p></article>
        ";


    }

    private function show() {
        $this->content .= "<article><h2>{$this->var->titre}</h2>";
        $this->content .= "<a href='{$this->app->urlFor('liste.edit', ['id' => $this->var->no])}'>Editer la liste</a>";


        $this->content .= "<ul>";
        foreach($this->var->items as $item) {
            $this->content .= "<p>{$item->nom}</p>";
            $this->content .= "<p>{$item->descr}</p>";
            $this->content .= "<img src='../../img_item/{$item->img}'>";
            $this->content .= "<hr>";
        }
        $this->content .= "</ul></article>";

    }

    private function showPublic() {
        $this->content .= '<article>';

        $this->content .= "<p>Vous voyez une liste partagée: {$this->app->urlFor('liste.showPublic', ['token' => $this->var->token])}</p>";

        $this->content .= "<h2>{$this->var->titre}</h2>";
        $this->content .= "<a href='{$this->app->urlFor('liste.edit', ['id' => $this->var->no])}'>Editer la liste</a>";


        $this->content .= "<ul>";
        foreach($this->var->items as $item) {
            $this->content .= "<p>{$item->nom}</p>";
            $this->content .= "<p>{$item->descr}</p>";
            $this->content .= "<img src='../../img_item/{$item->img}'>";
            $this->content .= "<hr>";
        }
        $this->content .= "</ul>";



        $this->content .= "<h3>Message :</h3>";
        $this->content .= "<p>pas fonctionnel</p>";


        $this->content .= '</article>';

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
        }

        $this->html();
    }

}
