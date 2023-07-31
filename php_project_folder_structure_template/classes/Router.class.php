<?php

class Router
{
    private $routes = array();

    /**
     * input => assoc array of route => route-file-name
     *
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * returns file associated to route
     */
    public function route(string $url)
    {
        foreach ($this->routes as $route => $file) {
            if (strpos($url, $route) !== false) {
                return $file;
            }
        }
        return 'error404.php';
    }
}
