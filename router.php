<?php
    require_once './app/controllers/TaskController.php';


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
            if(empty($params[1])) {
                $TaskController->showHome();
            } else {
                switch($params[1]){
                    case 'delete':
                        $TaskController->deleteTask($params[2]);
                    break;
                }
            }
        break;
        default:
            echo('404 Page not found');
        break;
    }

?>