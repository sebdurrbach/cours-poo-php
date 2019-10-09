<?php

namespace App;

class Router
{

    protected $path;
    protected $routes;

    /**
     * Constructeur
     *
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->initializePath(); // initialisation du path
        $this->routes = $routes;
    }

    /**
     * Execute le collable associé à la route en lui passant les params
     *
     * @return void
     */
    public function execute()
    {
        $route = $this->findMatchingRoute();

        if (!$route) {
            die("La page demandée n'existe pas");
        }

        $fonction = $this->routes[$route];
        $params = $this->getRouteParameters($route);
        $fonction($params);
    }

    /**
     * Trouver la route qui correspond à un chemin dans un tableau de routes
     *
     * @return string|bool
     */
    public function findMatchingRoute()
    {
        foreach ($this->routes as $route => $controller) {
            if ($this->match($route)) {
                return $route;
            }
        }

        return false;
    }

    /**
     * Extrait les paramètres variables d'un chemin concret par rapport à un model de route
     *
     * @param string $route
     * @return array
     */
    public function getRouteParameters(string $route): array
    {
        $results = [];
        preg_match_all('/\{(.*?)\}/', $route, $results);
        $results = $results[1];

        $route = preg_replace('/\{.*?\}/', '(.*)', $route);
        $route = str_replace("/", "\/", $route);

        $params = [];
        preg_match_all("/$route/", $this->path, $params);

        array_splice($params, 0, 1);

        $options = [];
        foreach ($results as $index => $paramName) {
            $options[$paramName] = $params[$index][0];
        }

        return $options;
    }

    /**
     * Vérifie si un chemin concret correspond à un model de route
     *
     * @param string $route Le model de route à tester
     * @return boolean
     */
    protected function match(string $route): bool
    {
        $route = preg_replace('/\{.*?\}/', '(.+)', $route);
        $route = str_replace("/", "\/", $route);

        return preg_match("/^$route$/", $this->path);
    }

    /**
     * Initialise le path avec le chemin actuel du navigateur
     *
     * @return void
     */
    protected function initializePath()
    {
        $this->path = "/";

        if (array_key_exists('PATH_INFO', $_SERVER)) {
            $this->path = $_SERVER['PATH_INFO'];
        }
    }
}
