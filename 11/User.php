<?php

class User {

    public $db_connection;

    public function __construct($db_con) {
        $this->db_connection = $db_con;
    }

    public function showUsers() {
        //alle users ophalen
        $sql = "SELECT * FROM user";
        $result = $this->db_connection->query($sql);

        //users laten zien
        foreach ($result as $row) {
            echo $row["naam"] . "<br>";
        }
    }

    public function getUser($username, $password) {

        //user zoeken op naam en wachtwoord
        $sql = "SELECT * FROM user
                WHERE naam = :naam
                AND wachtwoord = :wachtwoord";

        //prepared statement maken
        $stmt = $this->db_connection->prepare($sql);
        $stmt->bindParam(":naam");

        //naam koppelen aan username
        //wachtwoord koppenelen aan password
        //query

        return null; //check wat te return
    }
}

?>