<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function getHandler($method, $uri)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['path'] === $uri) {
                return [
                    'method' => $route['method'],
                    'controller' => $route['controller'],
                    'action' => $route['action']
                ];
            }
        }
    }
}
