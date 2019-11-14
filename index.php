<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('error_log', __DIR__ . '/php_errors_' . date("Ymd", time()) . '.log');
ini_set('log_errors', 1);
session_start();
include_once __DIR__ . '/autoload.php';

$action = $_GET['action'] ?? 'TasksList';
print_r($_GET);
$controller = new TasksController();
$controller->{$action}();
