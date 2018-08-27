<?php
namespace Router;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Request
{

	protected $getKey;
	protected $serverMethod;
	protected $postKey;
	protected $serverRequest;
	protected $serverUrl;

	/**
	 *
	 * @param type $key
	 * @return type
	 */
	public function getData($key)
	{
		$this->getKey = $_GET[$key];
		return isset($this->getKey) && !empty($this->getKey) ? $this->getKey : null;
	}

	/**
	 *
	 * @return type
	 */
	public function method()
	{
		$this->serverMethod = $_SERVER['REQUEST_METHOD'];
		return $this->serverMethod;
	}

	/**
	 *
	 * @param type $key
	 * @return type
	 */
	public function postData($key)
	{
		$this->postKey = $_POST[$key];
		return isset($this->postKey) && !empty($this->postKey) ? $this->postKey : null;
	}

	/**
	 *
	 * @param type $key
	 * @return type
	 */
	public function postExists($key)
	{
		$this->postKey = $_POST[$key];
		return isset($this->postKey);
	}

	/**
	 *
	 * @return type
	 */
	public function requestURI()
	{
		$this->serverRequest = $_SERVER['REQUEST_URI'];
		return $this->serverRequest;
	}

	/**
	 *
	 * @return type
	 */
	public function requestURL()
	{
		// return $_SERVER['REDIRECT_SCRIPT_URL']; en ligne
		$this->serverUrl = $_SERVER['REDIRECT_URL'];
		return $this->serverUrl;
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
