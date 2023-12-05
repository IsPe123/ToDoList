<?php
    require_once('./app/controllers/UserController.php');
    require_once('./app/helpers/DBHelper.php');

    class UserModel {
        private $DBHelper;
        private $db;

        public function __construct() {
            $this->DBHelper = new DBHelper();
            $this->db = $this->DBHelper->connect();
        }

        public function getUser($email) {
            $query = $this->db->prepare('SELECT * FROM users WHERE email = ? ');
            $query->execute([$email]);
            $user = $query->fetchAll(PDO::FETCH_OBJ);
            if (count($user) > 0) {
                return $user[0];
            }
            return null;
        }

        public function existEmail($email) {
            $query = $this->db->prepare("SELECT email FROM users WHERE email = ? ");
            $query->execute([$email]);
            $response = $query->fetch(PDO::FETCH_OBJ);
            if($response) {
                return true;
            }
            return false;
        }

        public function createNewUser($name, $userEmail, $userPassword) {
            $query = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $query->execute([$name, $userEmail, $userPassword]);
            return $query->rowCount();
        }

    }
?>
