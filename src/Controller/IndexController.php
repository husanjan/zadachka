<?php


namespace App\Controller;

use App\Resources\View\View;
use App\Model\Taskmodel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


 class IndexController
{

 private const PAGES = 3;


    public function send(ServerRequestInterface $request, ResponseInterface $response)
    {
        $model = new Taskmodel();

        $cookie = $request->getCookieParams();
        $get = $request->getQueryParams();

        $orderBy = $get['orderBy'] ?? 'orderbydesc';
        $sortBy = $get['sortBy'] ?? 'created_at';

        $tasks = $model->all();
        $pages = ceil(count($tasks) / self::PAGES);
        $currPage = (int)max((int)($get['page'] ?? 1), 1);
        $currPage = (int)min($currPage, $pages);

     if ($sortBy === 'created_at') {
            $tasks = $model->getPages($currPage, self::PAGES, $orderBy);
        }

        $view = (new View())
            ->set('tasks', $tasks)
            ->set('userLogin', $cookie['login'] ?? null)
            ->set('pages', $pages)
            ->set('curr_page', $currPage)
            ->set('order_by', $orderBy)
            ->set('sort_by', $sortBy);

        $html = $view->render('index');

        $response->getBody()->write($html);

        return $response;
    }
}
