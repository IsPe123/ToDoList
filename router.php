<?php
require_once './app/controllers/TaskController.php';
require_once './config.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}


$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $TaskController = new TaskController();
        $TaskController->showHome();
    break;
    default:
        echo('404 Page not found');
    break;
}

?>