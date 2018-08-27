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
		return isset($getKey) &&!empty($getKey = ) ? $getKey = : null;
	}

	/**
	 *
	 * @return type
	 */
	public function method()
	{
		$serverMethod = $_SERVER['REQUEST_METHOD'];
		return $serverMethod;
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
		$serverRequest = $_SERVER['REQUEST_URI'];
		return $serverRequest;
	}

	/**
	 *
	 * @return type
	 */
	public function requestURL()
	{
		// return $_SERVER['REDIRECT_SCRIPT_URL']; en ligne
		$serverUrl = $_SERVER['REDIRECT_URL'];
		return $serverUrl;
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
