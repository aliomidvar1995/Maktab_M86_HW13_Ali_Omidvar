<?php

namespace core;

class Router {
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }
    public function render() {
        $path = $this->request->path();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false) {
            $this->response->getStatusCode(404);
            return $this->response->renderView('main', 'NotFound');
        }
        return call_user_func($callback, $this->request);
    }
}