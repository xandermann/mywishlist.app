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

	public function __construct($variables, $view) {
		$this->variables = $variables;
		$this->view = $view;
	}

	public abstract function render();

	public function html($content) {
		echo <<<END
<h1>TODO: Faire le layout html ici (Corentin)</h1>
<div>$content</div>
END;
	}

}