<?php
    require_once 'app/validators/BaseValidator.class.php';

    class ContactsValidator extends BaseValidator {
        public static function checkPhone($optionName) {
            if (!isset($_POST[$optionName])) {
                return false;
            }
            
            $phone = $_POST[$optionName];

            return preg_match('/(^\+7|^\+3){1}([0-9]){8,10}$/', $phone);
        }
    }
?>