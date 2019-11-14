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
        header("Location: http://31.184.254.242/tasks/"); 
        exit();
    }

}