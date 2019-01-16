<?php

namespace wishlist\views;

use wishlist\classes\Authentification as Auth;

abstract class View {

	/**
	 * La(Les) variable(s) de la page
	 * @var array
	 */
	protected $var;

	/**
	 * Contenu
	 * @var string
	 */
	protected $content;

	/**
	 * Slim
	 * @var \Slim\Slim
	 */
	protected $app;

	private $nav;

	public function __construct($var = null) {
		$this->var = $var;
		$this->content = "";
		$this->app = \Slim\Slim::getInstance();

		if(Auth::check()) {
			$this->nav = "<li><a href='{$this->app->urlFor('index')}'>Accueil</a></li><li><a href='{$this->app->urlFor('auth.account')}'>Espace connexion</a></li><li><a href='{$this->app->urlFor('liste.publique')}'>Voir les listes publiques</a></li><li><a href='{$this->app->urlFor('liste.create')}'>Créer une liste</a></li><li><a href='{$this->app->urlFor('liste.index')}'>Voir vos listes</a></li>";
		} else {
			$this->nav = "<li><a href='{$this->app->urlFor('index')}'>Accueil</a></li><li><a href='{$this->app->urlFor('liste.publique')}'>Voir les listes publiques</a></li>";
		}

	}

	public abstract function render($view);

	public function html() {
		echo <<<END
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>INDEX</title>
	<link rel="stylesheet" href="{$this->app->urlFor('css')}">
</head>
<body>

	<div class="content">
		<header>
			<h1>My Wishapp</h1>

			<nav>
				<ul>
					$this->nav
				</ul>
			</nav>
		</header>


		<section>
		$this->content
		</section>


		<footer>
			<p>Site réalisé par <strong>Da Silva Carmo Alexandre</strong>, <strong>Battani Lilian</strong>, <strong>Vernevaut Corentin</strong>, <strong>Hublau Alexandre</strong>.</p>
		</footer>
	</div>

</body>
</html>
END;
	}

}
