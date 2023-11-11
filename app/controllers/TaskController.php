<?php
    require_once('app/models/TaskModel.php');
    require_once('app/views/TaskView.php');

    class TaskController {
        private $tareasModel;
        private $tareasView;

        public function __construct() {
            $TaskModel = new TaskModel();
            $TaskView = new TaskView();
        }
    }
?>