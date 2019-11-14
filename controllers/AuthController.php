<?php


class AuthController
{

    public function signUp(){
        if (Auth::signUp()){
            echo 'ok';
            return true;
        } else {
            echo 'Wrong password';
            return false;
        }
    }

    public function signOut(){
        Auth::signOut();
        if (isset($_GET['page'])) $page=$_GET['page'];
    	else $page = 0;
        if (isset($_GET['sortBy'])) $sort=$_GET['sortBy'];
        $tasks = $this->task->getTasks($page, $sort);
	    $this->view->show('TasksList', $tasks);
        return true;
    }

}