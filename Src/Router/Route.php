<?php
namespace Router;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Route
{

	protected $app;
	protected $url;
	protected $action;
	protected $matches;

	use \Blog\Hydrator;

	/**
	 *
	 * @param array $donnees
	 */
	public function __construct(array $donnees)
	{
		if (!empty($donnees)) {
			$this->hydrate($donnees);
		}
	}

	/**
	 *
	 * @param type $url
	 * @return boolean
	 * @throws \Exception
	 */
	public function match($url)
	{
		if (!preg_match('#^' . $this->url . '$#i', $url, $matches)) {
			return false;
		}
		if (isset($matches)) {
			if (isset($matches[1])) {
				$this->matches = intval($matches[1]);

				if ($this->matches == 0) {
					throw new \Exception(
					"L'identifiant de l'article n'est pas un nombre"
					);
				}
			}

			return true;
		}
	}

	/**
	 *
	 * @return type
	 */
	public function app()
	{
		return $this->app;
	}

	/**
	 *
	 * @return type
	 */
	public function action()
	{
		return $this->action;
	}

	/**
	 *
	 * @return type
	 */
	public function matches()
	{
		return $this->matches;
	}

	/**
	 *
	 * @param type $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 *
	 * @param type $app
	 */
	public function setApp($app)
	{
		$this->app = $app;
	}

	/**
	 *
	 * @param type $action
	 */
	public function setAction($action)
	{
		$this->action = $action;
	}
}
