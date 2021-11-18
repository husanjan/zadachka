<?php

namespace App\Controller;

use App\Resources\View\View;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


 class LoginController
{
    private const LOGIN = 'huseynjon';
    private const PASSW = 'huseynjon';

    /**
     * @inheritDoc
     */
    public function send(ServerRequestInterface $request, ResponseInterface $response)
    {
        $view = new View();

        if ('POST' === $request->getMethod()) {
            $post = $request->getParsedBody();
            $login = $post['login'] ?? null;
            $passw = $post['password'] ?? null;

            if (self::LOGIN === $login && self::PASSW === $passw) {
                return $response
                    ->withStatus(302)
                    ->withHeader('Location', '/')
                    ->withHeader('Set-Cookie', "login={$login}");
            }

            $view->set('login', $login)->set('errorMessage', 'User or password error');
        }

        $html = $view->render('login');

        $response->getBody()->write($html);

        return $response;
    }
}
