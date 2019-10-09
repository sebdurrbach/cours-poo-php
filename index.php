<?php

use App\Router;

require_once "config/autoload.php";

$routes = require "config/routes.php";

$router = new Router($routes);

$router->execute();
