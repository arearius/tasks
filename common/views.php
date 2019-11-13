<?php

class View{
    public function show($view, $data){
	$path = __DIR__ . '/../views/' . $view . '.php';
	include_once $path;
    }
}