<?php


namespace App\Controller;

use Exception;
use App\Resources\View\View;
use App\Model\TaskModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class TaskEditController
{

    public function send(ServerRequestInterface $request, ResponseInterface $response)
    {
        $model = new TaskModel();
        $cookie = $request->getCookieParams();
        $get = $request->getQueryParams();
        $taskId = $request->getAttribute('taskId', '');

        $userLogin = $cookie['login'] ?? null;

        $view = new View();
        $view
            ->set('userLogin', $userLogin)
            ->set('task_id', $taskId)
            ->set('curr_page', $get['page'] ?? 1);

        if ($userLogin === null) {
            $view->set('errorMessage', '401 ');
        } elseif ($userLogin !== 'admin') {
            $view->set('errorMessage', '403 ');
        }

        if ($userLogin === 'admin') {
            try {
                $task = $model->getById($taskId);
                if ('POST' === $request->getMethod()) {
                    $post = $request->getParsedBody();

                    $task
                        ->status ? $post['status'] : (0)
                        ->description ? $post['description'] : $task->description;

                    $view->set('successMessage', 'Задача успешно ');

                    try {
                        $model->persist($task);
                    } catch (Exception $e) {
                        $view->set('errorMessage', $e->getMessage());
                    }
                }
                $view
                    ->set('status', $task->status)
                    ->set('name', $task->userName)
                    ->set('mail', $task->userEmail)
                    ->set('desc', $task->description);
            } catch (Exception $e) {
                $view->set('errorMessage', $e->getMessage());
            }
        }

        $html = $view->render('task_edit');

        $response->getBody()->write($html);

        return $response;
    }
}
