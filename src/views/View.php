<?php

namespace wishlist\views;

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

	public function __construct($var = null) {
		$this->var = $var;
		$this->content = "";
		$this->app = \Slim\Slim::getInstance();
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
					<li><a href="{$this->app->urlFor('index')}">Accueil</a></li><li><a href='{$this->app->urlFor('liste.index')}'>Voir les listes publiques</a></li><li><a href='{$this->app->urlFor('liste.create')}'>Créer une liste</a></li>
				</ul>
			</nav>
		</header>


		<section>
		$this->content
		</section>
		

		<footer>
			<p>Site réalisé par [...]</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore natus accusamus consectetur dolores eum repudiandae laborum iste voluptas earum, expedita officia voluptatum velit amet ducimus deserunt sequi quaerat ullam necessitatibus reprehenderit doloremque, dignissimos hic et aut optio ipsam. Inventore saepe rerum fugit quos. Explicabo aperiam ullam eum cupiditate cum alias.</p>
		</footer>
	</div>

</body>
</html>
END;
	}

}