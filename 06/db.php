<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "webshop";

//verbinding maken met database
$connection = mysqli_connect($host, $user, $password, $dbname);

if (!$connection) {
    die("Database connectie mislukt.");
}