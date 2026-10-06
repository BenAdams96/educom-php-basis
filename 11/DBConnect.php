<?php

class DBConnect {
    //DI = dependency injection
    static $db; //static betekent dat variabele bij de class zelf hoort, niet het object.
    private $dbh; //hier word het PDO object in opgeslagen

    private function __construct() {
        try { //try to get PDO connection
            $this->dbh = new PDO(
                "mysql:host=localhost;dbname=webshop",
                "root",
                ""
            );

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }
    //Instance niet aanmaken in de constructor want constructor word pas uitgevoerd als nieuw object word gemaakt.
    //lazy initialization
    public static function getInstance() { //makes it kind of a singleton
        if (!isset(DBConnect::$db)) { //if not existing, create it.
            DBConnect::$db = new DBConnect();
        }

        return DBConnect::$db->dbh;
    }
}

?>