<?php

    require_once('./app/views/TaskController.php');

    class TaskView {
        public function __construct() {}

        public function showHome() {
            require './templates/header.phtml';
            require './templates/tasks.phtml';
            require './templates/header.phtml';
        }
    }
?>