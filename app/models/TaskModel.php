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

        public function finalizeTask($id_task) {
            $query = $this->db->prepare('UPDATE tasks SET finalize = CASE WHEN finalize = 0 THEN 1 WHEN finalize = 1 THEN 0 END WHERE id_task = ?');
            $query->execute([$id_task]);
        }

        //FALTA TERMINAR Y AGREGAR EL ID DEL USER
        public function addTask($title, $description) {
            $query = $this->db->prepare('INSERT INTO tasks (title, description) VALUES (?,?)');
            $query->execute([$title, $description]);
        }
    }
?>