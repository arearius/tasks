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
        if (isset($_GET['sortBy'])) $sort=$_GET['sortBy'];
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
            'user_name' => Helpers::getPost('user_name'),
            'mail' => Helpers::getPost('mail'),
            'text' => Helpers::getPost('text')
        ];
        echo 'add task;';
        echo '<pre>';
        print_r($task);
        echo '</pre>';
	    $this->task->addTask($task);
	    $sort = 0;
	    $page = 0;
	    $tasks = $this->task->getTasks($page, $sort);
	    $this->view->show('TasksList', $tasks);
    }

    public function updateTask(){
        if ($_POST['status'] == 'on') $status=1;
        else $status=0;
        $newTask = [
            'id' => $_GET['id'],
            'user_name' => $_POST['user_name'],
            'mail' => $_POST['mail'],
            'status' => $status,
            'text' => $_POST['text']
        ];
        $task = $this->task->updateTask($newTask);
	    $sort = 0;
	    $page = 0;
	    $tasks = $this->task->getTasks($page, $sort);
	    $this->view->show('TasksList', $tasks);
    }

}