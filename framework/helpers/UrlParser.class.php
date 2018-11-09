<?php
    

    class UrlParser {
        public static function parse() {
            $pos = strpos($_SERVER['REQUEST_URI'], '?');
            if (!$pos) {
                return $_SERVER['REQUEST_URI'];
            }

            return substr($_SERVER['REQUEST_URI'], 0, $pos);
        }
    }
?>