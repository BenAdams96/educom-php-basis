<?php

require "db.php";

try {

    //connectie maken met database
    $dbh = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
    );

    //formulier is verstuurd
    if ($_SERVER["REQUEST_METHOD"] === "POST" &&
        isset($_POST["id"], $_POST["naam"], $_POST["prijs"])) {

        $id = $_POST["id"];
        $naam = $_POST["naam"];
        $prijs = $_POST["prijs"];

        //item aanpassen in database
        $sth = $dbh->prepare(
            "UPDATE items
             SET naam = :naam, prijs = :prijs
             WHERE id = :id"
        );

        $sth->execute([
            "naam" => $naam,
            "prijs" => $prijs,
            "id" => $id
        ]);

        //terug naar overzicht
        header("Location: show.php");
        exit;
    }

    //id ophalen uit url
    $id = $_GET["id"];

    //juiste item ophalen
    $sth = $dbh->prepare(
        "SELECT * FROM items WHERE id = :id"
    );

    $sth->execute([
        "id" => $id
    ]);

    $item = $sth->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $error) {

    die("Database error: " . $error->getMessage());
}

?>

<h2>Item aanpassen</h2>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?php echo $item["id"]; ?>"
    >

    Naam:
    <input
        type="text"
        name="naam"
        value="<?php echo $item["naam"]; ?>"
    >
    <br>

    Prijs:
    <input
        type="text"
        name="prijs"
        value="<?php echo $item["prijs"]; ?>"
    >
    <br>

    <input
        type="submit"
        value="Update"
    >

</form>