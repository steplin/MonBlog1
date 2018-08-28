<?php
namespace Router;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Response
{

	/**
	 *
	 * @param type $location
	 */
	public function redirect($location)
	{
		header('Location: ' . $location);
	}

	public function redirect404()
	{
		include __DIR__ . '/../../Errors/404.html';
		exit;
	}
}
