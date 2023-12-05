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

        private function checkSession() {
            session_start();
            if (empty($_SESSION['email'])) {
                header("Location: " . BASE_URL . "login");
            } else {
                return true;
            }
        }

        public function showHome() {
            if ($this->checkSession()) {
                $tasks = $this->TaskModel->getTasks($_SESSION['id']);
                $this->TaskView->showHome($tasks);
                var_dump($_SESSION);
            }
        }

        public function deleteTask($id_task) {
            if ($this->checkSession()) {
                $this->TaskModel->deleteTask($id_task, $_SESSION['id']);
                header("Location: " . BASE_URL . "home");
            }
        }

        public function finalizeTask($id_task) {
            if ($this->checkSession()) {
                $this->TaskModel->finalizeTask($id_task, $_SESSION['id']);
                header("Location: " . BASE_URL . "home");
            }
        }

        public function addTask() {
            if ($this->checkSession()) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $id = $_SESSION['id'];
                $this->TaskModel->addTask($title, $description, $id);
                header("Location: " . BASE_URL . "home");
            }
        }

    }
?>