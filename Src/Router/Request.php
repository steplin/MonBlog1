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
        return isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : null;
    }

    /**
     *
     * @return type
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     *
     * @param type $key
     * @return type
     */
    public function postData($key)
    {
        return isset($_POST[$key])
            && !empty($_POST[$key]) ? $_POST[$key] : null;
    }

    /**
     *
     * @param type $key
     * @return type
     */
    public function postExists($key)
    {
        return isset($_POST[$key]);
    }

    /**
     *
     * @return type
     */
    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     *
     * @return type
     */
    public function requestURL()
    {
        // return $_SERVER['REDIRECT_SCRIPT_URL']; en ligne
        return $_SERVER['REDIRECT_URL'];
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
