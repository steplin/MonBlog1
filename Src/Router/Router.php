<?php

namespace Router;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
use Blog\Helpers\SessionHelper;

class Router
{
    protected $response;
    protected $request;
    protected $session;
    protected $route = '';

    /**
     *
     */
    public function __construct()
    {
        $this->response = new Response();
        $this->request = new Request();
        $this->session = new SessionHelper();
    }

    /**
     *
     * @param type $routes
     * @throws \Exception
     */
    public function findRoute($routes)
    {
        if (isset($routes)) {
            foreach ($routes as $route) {
                $routeMatch = new Route($route);
                if ($routeMatch->match($this->request->requestURL())) {
                    $this->route = $routeMatch;
                    $this->request->setGet('id', $this->route->matches());
                    if ($this->route->action() == "logout") {
                        $this->route->setApp('Backend');
                        $this->session->destroy();
                        $this->response->redirect('../');
                    }

                    if ($this->route->app() == 'Backend'
                        && !$this->session->isAuthenticated()
                    ) {
                        $this->response->redirect('../connexion.html');
                    }

                    if ($this->route->app() == 'Backend'
                        && $this->session->isAuthenticated()
                        && $this->session->session('role') != 1
                    ) {
                        $this->response->redirect('../');
                    }
                }
            }
        }
        if (!isset($routes)) {
            // Si aucune route ne correspond,
            // c'est que la page demandée n'existe pas.
            //$this->response->redirect404();
            throw new \Exception("Aucune route n'a été paramétrée");
        }
    }

    /**
     *
     * @throws \Exception
     */
    public function run()
    {
        if (empty($this->route)) {
            throw new \Exception("La page demandée n'hésite pas");
        }
        $controller = $this->getController($this->route);
        $method = $this->route->action();

        if (!method_exists($controller, $method)) {
            throw new \Exception("L'action  $method  n'a été paramétrée");
        }
        $controller->$method($this->request);
    }

    /**
     *
     * @param \Router\Route $route
     * @return \Router\controller
     * @throws \Exception
     */
    public function getController(Route $route)
    {
        if (!is_string($route->action())) {
            throw new \Exception("L'action doit être un texte valide");
        }

        $controller = "Controller\\".$route->app()."Controller";

        return new $controller(
            $this->response,
            $route->app(),
            $route->action(),
            $this->session
        );
    }
}
