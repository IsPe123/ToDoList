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

        public function getTasks($id) {
            $query = $this->db->prepare('SELECT * FROM tasks WHERE id_user = ?');
            $query->execute([$id]);
            $tasks = $query->fetchAll(PDO::FETCH_OBJ);
            return $tasks;
        }

        public function getIdUserByIdTask($id_task) {
            $query = $this->db->prepare('SELECT id_user FROM tasks WHERE id_task = ?');
            $query->execute([$id_task]);
            $id_user = $query->fetch(PDO::FETCH_OBJ);
            return $id_user;
        }

        public function deleteTask($id_task, $id_user) {
            $query = $this->db->prepare('DELETE FROM tasks WHERE id_task = ? AND id_user = ?');
            $query->execute([$id_task, $id_user]);
        }

        public function finalizeTask($id_task, $id_user) {
            $query = $this->db->prepare('UPDATE tasks SET finalize = CASE WHEN finalize = 0 THEN 1 WHEN finalize = 1 THEN 0 END WHERE id_task = ? AND id_user = ?');
            $query->execute([$id_task, $id_user]);
        }

        public function addTask($title, $description, $id) {
            $query = $this->db->prepare('INSERT INTO tasks (title, description, id_user) VALUES (?,?,?)');
            $query->execute([$title, $description, $id]);
        }
    }
?>