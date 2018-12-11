<?php

namespace wishlist\views;

abstract class View {

	/**
	 * La(Les) variable(s) de la page
	 * @var array
	 */
	protected $var;

	/**
	 * Nom de la vue (index, create ...)
	 * @var string
	 */
	protected $view;

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

	public function __construct($var, $view) {
		$this->var = $var;
		$this->view = $view;
		$this->content = "";
		$this->app = \Slim\Slim::getInstance();
	}

	public abstract function render();

	public function html() {
		echo <<<END
<h1>TODO: Faire le layout html ici (Corentin)</h1>
<div>$this->content</div>
END;
	}

}