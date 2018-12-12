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
<h1>TODO: Faire le layout html ici (Corentin)</h1>
<h2><a href="{$this->app->urlFor('index')}">INDEX</a> - <a href="{$this->app->urlFor('item.index')}">ITEM</a> - <a href="{$this->app->urlFor('liste.index')}">LISTE</a></h2>
<div>$this->content</div>
END;
	}

}