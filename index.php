<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('error_log', __DIR__ . '/php_errors_' . date("Ymd", time()) . '.log');
ini_set('log_errors', 1);
session_start();
include_once __DIR__ . '/autoload.php';

$action = $_GET['action'] ?? 'TasksList';
$controller = $_GET['controller'] ?? 'TaskController';
switch ($controller) {
    case 'AuthController' : $controller = new AuthController(); 
    default : $controller = new TaskController(); 
}

$controller->{$action}();
