<?php
namespace Blog\Helpers;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class SessionHelper
{

	public function setAuthenticated()
	{
		$_SESSION['auth'] = true;
	}

	/**
	 *
	 * @return type
	 */
	public function isAuthenticated()
	{
		$auth = $_SESSION['auth'];
		return isset($auth) && $auth === true;
	}

	/**
	 *
	 * @param type $var
	 * @param type $value
	 */
	public function setSession($var, $value)
	{
		$_SESSION[$var] = htmlspecialchars($value);
	}

	/**
	 *
	 * @param type $var
	 * @return type
	 */
	public function session($var)
	{
		$sessionVar = $_SESSION[$var];

		return isset($sessionVar) ? $sessionVar : null;
	}

	public function destroy()
	{
		session_destroy();
	}

	public function setFlash($message, $type = "success")
	{
		$_SESSION['flash'] = array(
			'message' => $message,
			'type' => $type
		);
	}

	public function flash()
	{
		$messageFlash = $_SESSION['flash'];
		if (isset($messageFlash)) {
			$flash = '<div class="alert alert-' . $messageFlash['type'] . '">';
			$flash .= '<h5>' . $messageFlash['message'] . '</h5></div>';
			echo $flash;
			unset($_SESSION['flash']);
		}
	}
}
