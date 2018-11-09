<?php

require_once 'framework/helpers/UrlParser.class.php';
require_once 'app/routing/Router.class.php';

class Framework {
    public static function run() {
        self::init();
        self::dispatch();

        // $blog = new Blog([
        //     'date' => date('Y-d-m H:i:s'),
        //     'subject' => 'super theme',
        //     'text' => 'WTF???'
        // ]);
        
        // $blog->save();
        // echo $blog->get()['id'];

        // $blog->save();
        // echo $blog->get()['id'];
        // $blog->save();
        // echo $blog->get()['id'];
        // $blog->save();
        // echo $blog->get()['id'];
    }

    private static function init() {
        // Define path constants
        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);
        define("APP_PATH", ROOT . 'application' . DS);
        define("FRAMEWORK_PATH", ROOT . "framework" . DS);
        define("PUBLIC_PATH", ROOT . "public" . DS);
        define("CONFIG_PATH", APP_PATH . "config" . DS);
        define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
        define("MODEL_PATH", APP_PATH . "models" . DS);
        define("VIEW_PATH", APP_PATH . "views" . DS);
        define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);
        define('DB_PATH', FRAMEWORK_PATH . "database" . DS);
        define("LIB_PATH", FRAMEWORK_PATH . "libraries" . DS);
        define("HELPER_PATH", FRAMEWORK_PATH . "helpers" . DS);
        define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);

        // Start session
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    private static function dispatch() {
        try {
            $path = $_SERVER['REQUEST_METHOD'] . UrlParser::parse();
            router::proceed($path);
        } catch (Exception $e) {
            echo $e->getMessage(), '\n';
        }
    }
}

?>