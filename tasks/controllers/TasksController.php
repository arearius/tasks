<?php


class TasksController
{
    private $task;
    private $view;

    public function __construct()
    {
	$this->task = new Task();
	$this->view = new View();
    }

    public function TasksList(){
	if (isset($_GET['page'])) $page=$_GET['page'];
	else $page=0;
	$sort = 0;
	$tasks = [];
	$tasks = $this->task->getTasks($page, $sort);
	$this->view->show('TasksList', $tasks);
    }

    public function signUp(){
//        include_once __DIR__ . '/../views/SignUp.php';
    }

    public function addTask(){
	print_r($_REUEST);
	$this->task->addTask();
	$sort = 0;
	$page = 0;
	$tasks = $this->task->getTasks($page, $sort);
	$this->view->show('TasksList', $tasks);
    }
}