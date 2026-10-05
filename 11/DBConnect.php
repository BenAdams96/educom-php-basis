<?php

class DBConnect {

    static $db;
    private $dbh;

    private function __construct() {

        try {

            $this->dbh = new PDO(
                "mysql:host=localhost;dbname=webshop",
                "root",
                ""
            );

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public static function getInstance() {
        if (!isset(DBConnect::$db)) {
            DBConnect::$db = new DBConnect();
        }

        return DBConnect::$db->dbh;
    }
}

?>