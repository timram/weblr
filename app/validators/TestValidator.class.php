<?php
    require_once 'app/validators/BaseValidator.class.php';

    class TestValidator extends BaseValidator {
        public static function checkMultipleOptions($optionName, $values) {
            if (!isset($_POST[$optionName])) {
                return false;
            }

            $options = $_POST[$optionName];

            if (sizeof($options) == 0 || sizeof($options) != sizeof($values)) {
                return false;
            }

            foreach ($values as $v) {
                if (!in_array($v, $options)) {
                    return false;
                }
            }
            return true;
        }

        public static function checkSingleOption($optionName, $value) {
            if (!isset($_POST[$optionName])) {
                return false;
            }
            
            $option = $_POST[$optionName];

            return $option == $value;
        }

        public static function checkGroup($optionName) {
            if (!isset($_POST[$optionName])) {
                return false;
            }
            return true;
        }
    }
?>