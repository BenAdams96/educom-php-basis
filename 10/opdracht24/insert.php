<?php

require "db.php";

try {

    //connectie maken met database
    $dbh = new PDO( //mischien in db bestandje doen volgende keer.
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
    );

    //als formulier is verstuurd
    if ($_SERVER["REQUEST_METHOD"] === "POST" &&
        isset($_POST["naam"], $_POST["prijs"])) {

        $naam = $_POST["naam"];
        $prijs = $_POST["prijs"];

        //nieuw item toevoegen
        $sth = $dbh->prepare(
            "INSERT INTO items (naam, prijs)
             VALUES (:naam, :prijs)"
        );

        $sth->execute([
            "naam" => $naam,
            "prijs" => $prijs
        ]);

        //terug naar page
        header("Location: show.php"); //terug naar page met alle data
    }
} catch (PDOException $error) {
    die("Database error: " . $error->getMessage()); //haal message op als er een error is met de DB
}

?>

<h2>Item toevoegen</h2>

<form method="POST">

    Naam:
    <input
        type="text"
        name="naam"
    >
    <br>

    Prijs:
    <input
        type="text"
        name="prijs"
    >
    <br>

    <input
        type="submit"
        value="Toevoegen"
    >

</form>