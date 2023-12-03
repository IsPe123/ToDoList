<?php

    class UserView {
        public function __construct() {}

        public function showLogin() {
            require './templates/login.phtml';
        }

        public function showRegister() {
            require './templates/register.phtml';
        }
    }

?>