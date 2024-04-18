<?php

class Router {
    protected $routes = [];

    public function get($route, $handler) {
        $this->routes[$route] = $handler;
    }

    public function dispatch() {
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        $url = trim($url, '/');

        echo "URL solicitada: $url<br>";

        if (array_key_exists($url, $this->routes)) {
            $handler = $this->routes[$url];
            echo "Handler encontrado: "; 
            $this->callHandler($handler);
        } else {
            echo 'Página não encontrada';
        }
    }

    protected function callHandler($handler) { 
        if (is_array($handler) && is_callable($handler) && is_object($handler[0])) {
            $controller = $handler[0];
            $methodName = $handler[1];
            echo "Instanciando controlador: " . get_class($controller) . "<br>";
            echo "Chamando método: $methodName<br>";
            $controller->$methodName();
        } else {
            echo 'Handler inválido';
        }
    }
}
