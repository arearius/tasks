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
        return true;
    }

}