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
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    /**
     *
     * @param type $var
     * @param type $value
     */
    public function setSession($var, $value)
    {
        $_SESSION[$var] = $value;
    }

    /**
     *
     * @param type $var
     * @return type
     */
    public function session($var)
    {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : null;
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
        if (isset($_SESSION['flash'])) {
            $flash = '<div class="alert alert-'.$_SESSION['flash']['type'].'">';
            $flash .= '<h5>'.$_SESSION['flash']['message'].'</h5></div>';
            echo $flash;
            unset($_SESSION['flash']);
        }
    }
}
