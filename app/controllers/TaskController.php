<?php
    require_once('app/models/TaskModel.php');
    require_once('app/views/TaskView.php');

    class TaskController {
        private $TaskModel;
        private $TaskView;

        public function __construct() {
            $this->TaskModel = new TaskModel();
            $this->TaskView = new TaskView();
        }

        public function showHome() {
            $tasks = $this->TaskModel->getTasks();
            $this->TaskView->showHome($tasks);
        }

        public function deleteTask($id_task) {
            $this->TaskModel->deleteTask($id_task);
            header("Location: " . BASE_URL . "home");
        }

        public function finalizeTask($id_task) {
            $this->TaskModel->finalizeTask($id_task);
            header("Location: " . BASE_URL . "home");
        }

        public function addTask() {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $this->TaskModel->addTask($title, $description);
            header("Location: " . BASE_URL . "home");
        }

    }
?>