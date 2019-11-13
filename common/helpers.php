<?php

class Helpers {

    public static function getPost($param){
        return extract(array_map('htmlspecialchars', $_POST[$param]), EXTR_OVERWRITE);
    }

    public static function getGet($param){
        return extract(array_map('htmlspecialchars', $_GET[$param]), EXTR_OVERWRITE);
    }

}