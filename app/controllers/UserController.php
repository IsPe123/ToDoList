<?php
    require_once('app/models/UserModel.php');
    require_once('app/views/UserView.php');

    class UserController {
        private $UserModel;
        private $UserView;

        public function __construct() {
            $this->UserModel = new UserModel();
            $this->UserView = new UserView();
        }

        public function showLogin($message = ''){
            $this->UserView->showLogin();
        }

        public function showRegister(){
            $this->UserView->showRegister();
        }

        public function verify() {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            if ($this->verifyUser($userEmail, $userPassword)) {
                header("Location: " . BASE_URL . "home");
            } else {
                $this->showLogin('Introduce bien los datos');
            }
        }

        private function verifyUser($userEmail, $userPassword) {
            $user = $this->UserModel->getUser($userEmail);
            if (!empty($user) && password_verify($userPassword, $user->pass)) {
                session_start();
                $_SESSION['id'] = $user->id;
                $_SESSION['email'] = $user->email;
                return true;
            }
            return false;
        }

        public function logout() {
            session_start();
            session_destroy();
            header("Location: " . BASE_URL . "home");
        }

    }
?>