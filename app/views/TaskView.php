<?php

    class TaskView {
        public function __construct() {}

        public function showHome($tasks) {
            require './templates/header.phtml';
            require './templates/formTasks.phtml';
            require './templates/tasks.phtml';
            require './templates/footer.phtml';
        }
    }

?>