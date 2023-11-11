<?php
    require_once('app/controllers/TaskController.php');

    class TaskModel {
        private $tareasController;
        private $db;

        public function __construct() {
            $tareasModel = new TaskController();
            
        }

        public function getTasks() {

        }
    }
?>