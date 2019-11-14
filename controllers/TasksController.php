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
    	if (isset($_GET['page'])) {
            $page=Helpers::getGet($_GET['page']);
            echo 'page =' . $page;
        }
    	else $page = 0;
        if (isset($_GET['sortBy'])) $sort=Helpers::getGet($_GET['sortBy']);
        else $sort = 0;
        $tasks = $this->task->getTasks($page, $sort);
        $tasks_count = $this->task->getTasksCount();
        $data = [
            'tasks' => $tasks,
            'tasks_count' => $tasks_count,
            'page' => $page
        ];
	    $this->view->show('TasksList', $data);
    }

    public function updateError(){
        echo 'Для обновления задач необходимо авторизоваться!';
        sleep(5);
        header("Location: http://31.184.254.242/tasks/");
        exit();
    }

    public function addTask(){
        $sort = 0;
	    $page = 1;	    
        $task = [
            'user_name' => Helpers::getPost('user_name'),
            'mail' => Helpers::getPost('mail'),
            'text' => Helpers::getPost('text')
        ];
	    $this->task->addTask($task);
        $tasks = $this->task->getTasks($page, $sort);
        $tasks_count = $this->task->getTasksCount();
        $data = [
            'tasks' => $tasks,
            'tasks_count' => $tasks_count,
            'page' => $page
        ];
	    $this->view->show('TasksList', $data);
    }

    public function updateTask(){
        if (Auth::getAuth()) {
            $sort = 0;
            $page = 1;            
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
            $tasks = $this->task->getTasks($page, $sort);
            $tasks_count = $this->task->getTasksCount();
            $data = [
                'tasks' => $tasks,
                'tasks_count' => $tasks_count,
                'page' => $page
            ];
            $this->view->show('TasksList', $data);
        } else {
            $this->view->show('UpdateErrorByAuth');
        }
    }

}