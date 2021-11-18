<?php


namespace App\Model;

class Task
{
    public const TASK_STATUS_NEW = 0;
    public const TASK_STATUS_DONE = 1;


    public $taskId;

    private $createdAt = 0;
    public $status = 0;
    public $userName = '';

    public $userEmail = '';

    public $description = '';

    public function hasId()
    {
        return $this->taskId !== null;
    }
    function  setPost($user_name,$user_email,$description)
    {
         $this->userName=$user_name;
         $this->userEmail=$user_email;
         $this->description=$description;
         $this->createdAt=time();
         $this->status = self::TASK_STATUS_NEW;
        return $this;

    }

    public function __construct($taskId = null)
    {
        $this->taskId = $taskId;
    }

    public function withId($taskId)
    {
        $new = clone $this;
        $new->taskId = $taskId;

        return $new;
    }

    public function getId()
    {
        return $this->taskId;
    }

}
