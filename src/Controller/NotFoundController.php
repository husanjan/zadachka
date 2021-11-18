<?php


namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class NotFoundController
 *
 * @package App\Controller
 */
class NotFoundController
{
    /**
     * @inheritDoc
     */
    public function send(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write('404 File not found');

        return $response
            ->withHeader('Content-Type', 'text/plain')
            ->withStatus(404);
    }
}
