<?php


class  Auth
{

    public static function getAuth()
    {
        if ($_SESSION['authorized']) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function signUp()
    {
        if (Helpers::validate($_POST['user_name']) == 'admin' && Helpers::validate($_POST['user_password']) == '123'){
            $_SESSION['authorized'] = true;
            return true;
        } 
        return false;
    }

    public static function signOut()
    {
        $_SESSION['authorized'] = false;
    }

}