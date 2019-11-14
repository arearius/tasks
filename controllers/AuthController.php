<?php


class AuthController
{

    public function signUp(){
        if (Auth::signUp()){
            echo 'signUp success';
            return 'ok';
        } else {
            return 'Wrong password';
        }
    }

    public function signOut(){
        Auth::signOut();
        return true;
    }

}