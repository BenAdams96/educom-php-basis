<?php

require "DBConnect.php";
require "Person.php";

//database connectie ophalen
$db_handle = DBConnect::getInstance();

//database connectie meegeven aan Person
$person = new Person($db_handle);

//personen tonen
$person->showPersons();

?>