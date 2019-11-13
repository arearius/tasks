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
        Auth::getAuth();
    	if (isset($_GET['page'])) $page=$_GET['page'];
    	else $page = 0;
    	$sort = 0;
    	$tasks = $this->task->getTasks($page, $sort);
	    $this->view->show('TasksList', $tasks);
    }

    public function signUp(){
        $page = 0;
        $sort = 0;
        Auth::signUp();
        $tasks = $this->task->getTasks($page, $sort);
        $this->view->show('TasksList', $tasks);
    }

    public function signOut(){
        $page = 0;
        $sort = 0;
        Auth::signOut();
        $tasks = $this->task->getTasks($page, $sort);
        $this->view->show('TasksList', $tasks);
    }

    public function addTask(){
        $task = [
            'user_name' => $_POST['user_name'],
            'mail' => $_POST['mail'],
            'text' => $_POSTp['text']
        ]
	    $this->task->addTask($task);
	    $sort = 0;
	    $page = 0;
	    $tasks = $this->task->getTasks($page, $sort);
	    $this->view->show('TasksList', $tasks);
    }

    public function updateTask(){
        $newTask = [
            'id' => $_POST['task_id'],
            'user_name' => $_POST['user_name'],
            'mail' => $_POST['mail'],
            'text' => $_POSTp['text']
        ]
        $task = $this->task->updateTask($newTask);
	    $sort = 0;
	    $page = 0;
	    $tasks = $this->task->getTasks($page, $sort);
	    $this->view->show('TasksList', $tasks);
    }

}