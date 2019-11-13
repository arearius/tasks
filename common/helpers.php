<?php

class Helpers {

    public static function getPost($param){
        return htmlspecialchars($_POST[$param]);
    }

    public static function getGet($param){
        return htmlspecialchars($_GET[$param]);
    }

}