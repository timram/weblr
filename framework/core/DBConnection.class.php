<?php
class DBConnection {
    public $dbh;
    private static $instance;

    private function __construct() {
        $dsn = 'mysql:dbname=testdatabase;host=127.0.0.1';                
        $user = 'root';
        $password = '2413timur';

        $this->dbh = new PDO($dsn, $user, $password);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}
?>