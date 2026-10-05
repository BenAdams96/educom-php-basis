<?php

class Person {

    public $db_connection; //connection

    public function __construct($db_con) {
        $this->db_connection = $db_con;
    }

    public function showPersons() {
        $sql = "SELECT * FROM user";
        $result = $this->db_connection->query($sql);
        // $this->db_connection->query() (voert ook direct uit)
        // gebruik try {} except {} (voor als connectie niet lukt)
        // alvast in de DBConnect.php

        foreach ($result as $row) {
            echo $row["naam"] . "<br>";
        }
    }
}

?>