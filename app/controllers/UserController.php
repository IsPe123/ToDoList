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

        public function showLogin($message = '') {
            $this->UserView->showLogin($message = '');
        }

        public function showRegister($message = '') {
            $this->UserView->showRegister($message = '');
        }

        //register falta terminar
        public function register() {
            if(!empty($_POST['email']) && (!empty($_POST['password']) && !empty($_POST['name']))){
                $name = $_POST['name'];
                $userEmail = $_POST['email'];
                $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $response = $this->UserModel->existEmail($userEmail);
                if(!$response) {
                    $this->UserModel->createNewUser($name, $userEmail, $userPassword);
                    $this->UserView->showLogin('¡Registrado con exito! Inicia sesion.');
                } else {
                    $this->UserView->showRegister('Email ya registrado, intenta con otro o inicia sesion');
                }
            }
        }

        public function verify() {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            if ($this->verifyUser($userEmail, $userPassword)) {
                header("Location: " . BASE_URL . "home");
            } else {
                $this->UserView->showLogin('Introduce bien los datos');
            }
        }

        private function verifyUser($userEmail, $userPassword) {
            $user = $this->UserModel->getUser($userEmail);
            if (!empty($user) && password_verify($userPassword, $user->password)) {
                session_start();
                $_SESSION['email'] = $user->email;
                $_SESSION['id'] = $user->id_user;
                return true;
            }
            return false;
        }

        public function logout() {
            session_start();
            session_destroy();
            header("Location: " . BASE_URL . "login");
        }

    }
?>