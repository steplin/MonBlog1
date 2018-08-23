<?php
session_start();

header('X-Frame-Options: DENY');
header("Vary: Accept-Encoding");


require 'vendor/autoload.php';

require 'App/routes.php';

$router = new Router\Router();

$router->findRoute($routes);

$router->run();
