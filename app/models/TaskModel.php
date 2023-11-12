<?php
    require_once('./app/controllers/TaskController.php');
    require_once('./app/helpers/DBHelper.php');

    class TaskModel {
        private $DBHelper;
        private $db;

        public function __construct() {
            $this->DBHelper = new DBHelper();
            $this->db = $this->DBHelper->connect();
        }

        public function getTasks() {
            $query = $this->db->prepare('SELECT * FROM tasks');
            $query->execute();
            $tasks = $query->fetchAll(PDO::FETCH_OBJ);
            return $tasks;
        }

        public function deleteTask($id_task) {
            $query = $this->db->prepare('DELETE FROM tasks WHERE id_task = ?');
            $query->execute([$id_task]);
        }
    }
?>