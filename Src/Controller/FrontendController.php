<?php

namespace Controller;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Router\Request;
use \Blog\Helpers\SessionHelper;

class FrontendController 
{

    /**
     *
     * @param Request $request
     */
    public function index()
    {
        echo 'FrontendController';
    }

   
}
