<?php

namespace Controller;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use \Router\Response;
use \Router\Page;

class Controller
{
    protected $action = '';
    protected $page = null;
    protected $manager;
    protected $session;

    /**
     *
     * @param Response $response
     * @param type $app
     * @param type $action
     * @param type $session
     */
    public function __construct(Response $response, $app, $action, $session)
    {
        $this->reponse = $response;
        $this->page = new Page($session);
        $this->setApp($app);
        $this->setAction($action);
        $this->setView($action);
        $this->setSession($session);
    }

    /**
     *
     * @param type $entity
     * @return \Controller\class
     */
    public function getManager($entity)
    {
        $class = '\\Model\\'.ucfirst($entity)."Manager";
        return new $class();
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
    public function page()
    {
        return $this->page;
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

    /**
     *
     */
    public function setView()
    {
        $this->page->setPathView('Src/Views/'.$this->app);

        $this->page->setFileView($this->action.'.html');
    }

    /**
     *
     * @param type $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }
}
