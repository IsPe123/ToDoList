<?php

    class UserView {
        public function __construct() {}

        public function showLogin($message = '') {
            require './templates/login.phtml';
        }

        public function showRegister($message = '') {
            require './templates/register.phtml';
        }
    }

?>