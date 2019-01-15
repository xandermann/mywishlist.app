<?php

namespace wishlist\classes;

use wishlist\classes\ValidatorException;

class Validator {

	/**
	 * Filtre du validateur
	 */
	const STRING = 0;
	const FLOAT = 1;
	const URL = 2;
	const EMAIL = 3;
	const INT = 4;
	const DATE = 5;
	const PASSWORD = 6;



	/**
	 * Slim
	 * @var \Slim\Slim
	 */
	private $app;
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}

	/**
	 * Methode de filtrage des donnees
	 * @param  array  $filters          Definition de l'ensemble des filtres pour les donnees
	 * @param  string $redirectIfError  Lien de redirection si les filtres ne sont pas OK
	 * @param  array  $urlParam         Parametre du lien
	 * @return array                    Ensemble des donnees filtrees
	 */
	public function __invoke(array $filters, $redirectIfError, $urlParam = []) {

		// Tests des filtres, si pas ok, alors renvoie une exception
		// Si ok, alors retourne les donnees filtrees
		try {
			return $this->validate($filters);
		} catch(ValidatorException $e) {

			// Redirige le client si erreur
			$this->app->redirect($this->app->urlFor($redirectIfError, $urlParam) . "?error={$e->field}");
		}

	}

	/**
	 * Valide les donnees
	 * @param  array $filters Les filtres
	 * @return array          Les donnees filtrees
	 */
	private function validate(array &$filters) {

		$request = $this->app->request; // Requete
		$ret = []; // Retourne a la fin

		// Pour chaque filtres passe en parametre
		foreach($filters as $variableToFilter => $filter) {

			// On regarde s'il existe, sinon c'est null
			$paramToTest = $request->params($variableToFilter) ?? null;

			// On applique le filtre correspondant
			switch ($filter) {

				// Si doit etre un string
				case self::STRING:
				if(!empty($paramToTest) && strlen($paramToTest) < 100000)
					$ret[$variableToFilter] = filter_var($paramToTest, FILTER_SANITIZE_STRING);
				else
					throw new ValidatorException($variableToFilter);
				break;

				// Si doit etre un float
				case self::FLOAT:
				if(!filter_var($paramToTest, FILTER_VALIDATE_FLOAT))
					throw new ValidatorException($variableToFilter);
				else
					$ret[$variableToFilter] = $paramToTest;
				break;

				// Si doit etre une url
				case self::URL:
				if(!filter_var($paramToTest, FILTER_VALIDATE_URL))
					throw new ValidatorException($variableToFilter);
				else
					$ret[$variableToFilter] = $paramToTest;
				break;

				// Si doit etre un mail
				case self::EMAIL:
				if(!filter_var($paramToTest, FILTER_VALIDATE_EMAIL))
					throw new ValidatorException($variableToFilter);
				else
					$ret[$variableToFilter] = $paramToTest;
				break;


				// Si doit etre un int
				case self::INT:
				if(is_numeric($paramToTest))
					$ret[$variableToFilter] = $paramToTest;
				else
					throw new ValidatorException($variableToFilter);
				break;


				// Si doit etre une date
				case self::DATE:
				$date = $paramToTest;

				list($y, $m, $d) = explode('-', $date);

				if(checkdate($m, $d, $y)){
					$ret[$variableToFilter] = $paramToTest;
				} else {
					throw new ValidatorException($variableToFilter);
				}
				break;

				case self::PASSWORD:

				if (strlen($paramToTest) < 4) {
					throw new ValidatorException($variableToFilter . "_lenght_min_4");
				}

				if (!preg_match("#[0-9]+#", $paramToTest)) {
					throw new ValidatorException($variableToFilter . "_must_include_number");
				}

				if (!preg_match("#[a-zA-Z]+#", $paramToTest)) {
					throw new ValidatorException($variableToFilter . "_must_include_letter");
				}

				$ret[$variableToFilter] = $paramToTest;


				break;

				default:
				throw new \Exception('Donnee non traitee');
				die;

			}
		}

		return $ret;
	}

}