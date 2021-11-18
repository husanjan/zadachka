<?php


namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


 class LogoutController
{
    /**
     * @inheritDoc
     */
    public function send(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response
            ->withStatus(302)
            ->withHeader('Set-Cookie', 'login=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT; Max-Age=0')
            ->withHeader('Location', '/');
    }
}
