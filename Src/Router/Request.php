<?php
namespace Router;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Request
{

	/**
	 *
	 * @param type $key
	 * @return type
	 */
	public function getData($key)
	{
		$getKey = $_GET[$key];
		return isset($getKey) && !empty($getKey) ? $getKey : null;
	}

	/**
	 *
	 * @return type
	 */
	public function method()
	{
		$requestMethod = $_SERVER['REQUEST_METHOD'];
		return $requestMethod;
	}

	/**
	 *
	 * @param type $key
	 * @return type
	 */
	public function postData($key)
	{
		$postKey = $_POST[$key];
		return isset($postKey) && !empty($postKey) ? $postKey : null;
	}

	/**
	 *
	 * @param type $key
	 * @return type
	 */
	public function postExists($key)
	{
		$postKey = $_POST[$key];
		return isset($postKey);
	}

	/**
	 *
	 * @return type
	 */
	public function requestURI()
	{
		$serverRequestUri = $_SERVER['REQUEST_URI'];
		return $serverRequestUri;
	}

	/**
	 *
	 * @return type
	 */
	public function requestURL()
	{
		// return $_SERVER['REDIRECT_SCRIPT_URL']; en ligne
		$serverRedirectUrl = $_SERVER['REDIRECT_URL'];
		return $serverRedirectUrl;
	}

	/**
	 *
	 * @param type $key
	 * @param type $value
	 */
	public function setGet($key, $value)
	{
		$_GET[$key] = $value;
	}
}
