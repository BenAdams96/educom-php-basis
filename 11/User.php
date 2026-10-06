<?php

class User
{

    public $db_connection;

    public function __construct($db_con)
    {
        $this->db_connection = $db_con;
    }

    public function showUsers()
    {
        //alle users ophalen
        $sql = "SELECT * FROM user";
        $result = $this->db_connection->query($sql);

        //users laten zien
        foreach ($result as $row) {
            echo $row["naam"] . "<br>";
        }
    }

    public function getUser($username, $password)
    {

        //user zoeken op naam
        $sql = "SELECT * FROM user
                WHERE naam = :username"; //geen wachtwoord omdat we hash gebruiken

        $sth = $this->db_connection->prepare($sql);
        $sth->bindParam(":username", $username);
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_OBJ);

        //checken of user bestaat en wachtwoord klopt
        if ($result && password_verify($password, $result->wachtwoord)) {
            return $result;
        }

        return false;
    }

    public function insertUser($username, $password) {

        //wachtwoord hashen
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //nieuwe user toevoegen
        $sql = "INSERT INTO user (naam, wachtwoord)
                VALUES (:username, :password)";

        $sth = $this->db_connection->prepare($sql);

        $sth->bindParam(":username", $username);
        $sth->bindParam(":password", $hashed_password);

        $sth->execute();
    }
}
