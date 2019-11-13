<?php
//echo 'ok';
include_once __DIR__ . '/autoload.php';

$action = $_GET['action'] ?? 'TasksList';

$controller = new TasksController();
$controller->{$action}();
