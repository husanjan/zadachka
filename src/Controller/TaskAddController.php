<?php


namespace App\Controller;
use App\Controller\IndexController;
use Exception;
use App\Model\Task;
use App\Model\TaskModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


 class TaskAddController
{
    /**
     * @inheritDoc
     */
    public function send(ServerRequestInterface $request, ResponseInterface $response)
    {
        $post = $request->getParsedBody();

        $task = (new Task())
            ->setPost($post['user_name'],$post['user_email'],$post['description']);
        try {
            $mode = new Taskmodel();
            $mode->persist($task);
        } catch (Exception $e) {
            $response->getBody()->write($e->getMessage());

            return $response
                ->withHeader('Content-Type', 'text/plain')
                ->withStatus(500);
        }

        return $response
            ->withStatus(302)
            ->withHeader('Location', '/');
    }
}
