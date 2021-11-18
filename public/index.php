<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

include __DIR__ . '/../vendor/autoload.php';

$router = new App\routes\Router();
$router->get('/', function (Request $request, Response $response) {
        return (new App\Controller\IndexController())->send($request, $response);
    })->post('/tasks', function (Request $request, Response $response) {
        return (new App\Controller\TaskAddController())->send($request, $response);
    })->any('/tasks/(?<taskId>[a-z0-9]+)[/]?', function (Request $request, Response $response) {
        return (new App\Controller\TaskEditController())->send($request, $response);
    })  ->any('/login', function (Request $request, Response $response) {
        return (new App\Controller\LoginController())->send($request, $response);
    })
    ->get('/logout', function (Request $request, Response $response) {
        return (new App\Controller\LogoutController())->send($request, $response);
    })
    ->notFound(function (Request $request, Response $response) {
        return (new App\Controller\NotFoundController())->send($request, $response);
    });

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
$response = new Zend\Diactoros\Response();

$response = $router->run($request, $response);

foreach ($response->getHeaders() as $header => $values) {
    foreach ($values as $value) {
        header("{$header}: {$value}", false);
    }
}

http_response_code($response->getStatusCode());

echo (string)$response->getBody();
