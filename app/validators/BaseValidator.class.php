<?php
    class BaseValidator {
        public static function checkFIO($optionName) {
            if (!isset($_POST[$optionName])) {
                return false;
            }

            $fio = trim($_POST[$optionName]);

            return strlen($fio) > 0;
        }

        public static function checkMail($optionName) {
            if (!isset($_POST[$optionName])) {
                return false;
            }

            $mail = $_POST[$optionName];

            return preg_match('/.+@.+(.com$|.ru$|.ua$|.co$|.io$)/', $mail);
        }

        public static function checkNotEmpty($optionName) {
            if (!isset($_POST[$optionName])) {
                return false;
            }

            $value = $_POST[$optionName];

            return strlen($value) > 0;
        }
    }
?>