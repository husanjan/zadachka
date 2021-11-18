<?php


namespace App\routes;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

///this is class router
class Router
{
    //array
    private $routes;

    private $notFound;

    public function __construct()
    {
        $this->routes = [
            'GET'  => [],
            'POST' => [],
        ];
    }

    //http method
    private function addRoute( $httpMethod, $pathPattern, Closure $closure)
    {
        $this->routes[$httpMethod][$pathPattern] = $closure;

        return $this;
    }


    public function get( $pathPattern, Closure $closure)
    {
        return $this->addRoute('GET', $pathPattern, $closure);
    }
//path pattern
    public function post( $pathPattern, Closure $closure)
    {
        return $this->addRoute('POST', $pathPattern, $closure);
    }

//pattern
    public function any( $pathPattern, Closure $closure)
    {
        $this->addRoute('GET', $pathPattern, $closure);
        $this->addRoute('POST', $pathPattern, $closure);

        return $this;
    }


    public function notFound(Closure $closure)
    {
        $this->notFound = $closure;

        return $this;
    }

    //ServerRequestInterface $request

    public function route(ServerRequestInterface &$request)
    {
        $method = $request->getMethod();
        $path = $request->getUri()->getPath();

        if (!array_key_exists($method, $this->routes)) {
            return $this->notFound;
        }

        foreach ($this->routes[$method] as $pathPattern => $route) {
            $pattern = '@^' . $pathPattern . '$@';
            if (preg_match($pattern, $path, $matches)) {
                foreach ($matches as $name => $value) {
                    if (gettype($name) === 'string') {
                        $request = $request->withAttribute($name, $value);
                    }
                }

                return $route;
            }
        }

        return $this->notFound;
    }
//request server responce interface
    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        $route = $this->route($request);

        return $route($request, $response);
    }
}
