<?php

require("DBConnect.php");
require("Person.php");
require("User.php");

//database connectie ophalen
$db_connection = DBConnect::getInstance();

//connectie meegeven aan Person
$person = new Person($db_connection);
$person->showPersons();

//user object maken en connectie meegeven
$user = new User($db_connection);
$user->showUsers();
$user->getUser("ben","test123");

?>