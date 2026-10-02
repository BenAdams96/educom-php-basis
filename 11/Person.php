<?php

class Person {

    private $db_handle;

    function __construct($db_handle) {
        $this->db_handle = $db_handle;
    }

    function showPersons() {

        $sth = $this->db_handle->prepare("SELECT * FROM user");
        $sth->execute();

        $persons = $sth->fetchAll(PDO::FETCH_ASSOC);

        foreach ($persons as $person) {
            echo $person["naam"] . "<br>";
        }
    }
}