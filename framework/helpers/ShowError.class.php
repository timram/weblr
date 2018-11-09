<?php
    class ShowError {
        public static function show($name, $message) {
            if (isset($_SESSION['form_validity']) && !$_SESSION['form_validity'][$name]) {
                echo '<label class="error" for="' . $name . '">' . $message . '</label>';
            }
        }
    }
?>