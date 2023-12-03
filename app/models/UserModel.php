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
            $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
            $query->execute([$email]);
            $user = $query->fetchAll(PDO::FETCH_OBJ);

            if (count($user) > 0) {
                return $user[0];
            }
            return null;
        }

    }
?>
