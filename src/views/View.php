<?php

namespace wishlist\views;

abstract class View {

	/**
	 * Les variables de la page
	 * @var array
	 */
	protected $variables;

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

	public function __construct($variables, $view) {
		$this->variables = $variables;
		$this->view = $view;
		$this->content = "";
	}

	public abstract function render();

	public function html() {
		echo <<<END
<h1>TODO: Faire le layout html ici (Corentin)</h1>
<div>$this->content</div>
END;
	}

}