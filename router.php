<?php
    require_once './app/controllers/TaskController.php';
    require_once './app/controllers/UserController.php';


    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'login';
    }


    $params = explode('/', $action);

    switch ($params[0]) {
        case 'login':
            $UserController = new UserController();
            $UserController->showLogin();
        break;
        case 'register':
            $UserController = new UserController();
            $UserController->showRegister();
        break;
        case 'home':
            $TaskController = new TaskController();
            if(empty($params[1])) {
                $TaskController->showHome();
            } else {
                switch($params[1]){
                    case 'delete':
                        $TaskController->deleteTask($params[2]);
                    break;
                    case 'finalize':
                        $TaskController->finalizeTask($params[2]);
                    break;
                    case 'add':
                        $TaskController->addTask();
                    break;
                }
            }
        break;
        default:
            echo('404 Page not found');
        break;
    }

?>