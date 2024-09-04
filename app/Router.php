<?php

namespace App;

use InvalidArgumentException;

class Router
{
    private array $routes = [];
    private string $action = '';

    public function __construct(string $action, array $routes)
    {
        $this->action = $action;
        $this->routes = $routes;
    }

    public function route()
    {
        foreach ($this->routes as $route) {
            if ($this->action == $route->action() and $this->requestIs($route->verb()) and $this->requestHas($route->parameters())) {
                if ($route->hasMiddlewares()) {
                    $this->callMiddlewares($route->middlewares());
                }
                $this->callController($route->controller(), $route->method());
            }
        }
    }

    private function requestIs(string $verb): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $verb;
    }

    private function requestHas(array $parameters): bool
    {
        foreach ($parameters as $parameter => $constraints) {
            if (!$this->parameterHasGoodFormat($parameter, $constraints)) {
                return false;
            }
        }
        return true;
    }

    private function parameterIsMandatory(array|string $constraints): bool
    {
        if (!is_array($constraints)) {
            return true;
        }
        return (array_key_exists('mandatory', $constraints)
            and $constraints['mandatory']) or !array_key_exists('mandatory', $constraints);
    }

    private function parameterHasGoodFormat(string $parameter, array|string $constraints): bool
    {
        $mandatory = $this->parameterIsMandatory($constraints);
        if (is_string($constraints)) {
            $parameter = $constraints;
        }
        if ($mandatory and empty($_GET[$parameter])) {
            return false;
        }
        if (is_array($constraints) and array_key_exists('format', $constraints) and !empty($_GET[$parameter])) {
            return preg_match('/^' . $constraints['format'] . '$/', $_GET[$parameter]);
        }
        return true;
    }
    private function callMiddlewares(array $middlewares)
    {
        foreach ($middlewares as $middleware => $method) {
            $middleware = new $middleware();
            $middleware->$method();
        }
    }

    private function callController(string $controller, string $method)
    {
        if (!method_exists($controller, $method)) {
            throw new InvalidArgumentException('Impossible d\'appeler la méthode du contrôleur');
        }
        $controller = new $controller();
        $controller->$method();
    }
}
