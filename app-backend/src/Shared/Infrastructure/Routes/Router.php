<?php

namespace App\Shared\Infrastructure\Routes;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable $handler): void
    {
        $this->routes[strtoupper($method)][$path] = $handler;
    }

    public function dispatch(string $method, string $path)
    {
        $method = strtoupper($method);

        if (isset($this->routes[$method][$path])) {
            return call_user_func($this->routes[$method][$path]);
        }

        http_response_code(404);

        return json_encode(["error" => "Ruta no encontrada"]);
    }
}
