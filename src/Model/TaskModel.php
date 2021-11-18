<?php


namespace App\Model;

use Exception;



class TaskModel
{

    private $storage;


    public function __construct()
    {
        $this->initStorage();
    }


    private function initStorage()
    {
        $this->storage = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'tasks.json';

        if (!file_exists($this->storage)) {
            if (!file_put_contents($this->storage, '[]', LOCK_EX)) {
                throw new Exception('Could not create persistance storage!');
            }
        }
    }


    private function getStorage()
    {
        $storage = file_get_contents($this->storage);

        return json_decode($storage, true);
    }
//return
    public function all()
    {
        $tasks = $this->getStorage();
        $result = [];

        foreach ($tasks as $taskId => $task) {
            $result[$taskId] = (new Task($task['id']))
            ->setPost($task['user_name'],$task['user_name'],$task['user_email'],$task['description']);
        }

        return $result;
    }

    public function getById($topicId)
    {
        $tasks = $this->getStorage();

        if (!array_key_exists($topicId, $tasks)) {
            throw new Exception('not found');
        }

        $task = $tasks[$topicId];

        return (new Task($topicId))
            ->setPost($task['user_name'],
                $task['user_name'],
                $task['user_email'],
                $task['description']);
    }

    ///pages 1 2 3 4
    public function getPages( $page,  $perPage,  $orderBy = 'asc'): array
    {
        $tasks = $this->all();


        $offset = ($page - 1) * $perPage;

        return array_slice($tasks, $offset, $perPage, false);
    }


    public function persist(Task $task)
    {
        if (!$task->hasId()) {
            $task = $task->withId(uniqid());
        }

        $tasks = $this->getStorage();
        $tasks[$task->taskId] = [
            'id'          => $task->taskId,
            'status'      => $task->status,
            'user_name'   => $task->userName,
            'user_email'  => $task->userEmail,
            'description' => $task->description,
        ];

        $json = json_encode($tasks, JSON_UNESCAPED_UNICODE);

        if (!file_put_contents($this->storage, $json, LOCK_EX)) {
            throw new Exception(' not store a new task!');
        }
    }
}
