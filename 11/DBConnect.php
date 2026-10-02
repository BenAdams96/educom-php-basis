<?php

class DBConnect {

    private static $instance;

    public static function getInstance() {

        if (!self::$instance) {
            self::$instance = new PDO(
                "mysql:host=localhost;dbname=webshop",
                "root",
                ""
            );
        }

        return self::$instance;
    }
}