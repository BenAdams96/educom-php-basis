<?php
//NOTE TO SELF/BUGFIX: pagina refreshen zorgt nog voor dat Appel met 1 omhoog gaat
//NOTE TO SELF: also fix prettier extension + download better comments

session_start();

$items = [
    ["naam" => "Appel", "prijs" => 1.25],
    ["naam" => "Banaan", "prijs" => 0.95]
];

//check of er een item is toegevoegd
if (isset($_POST["item"])) {

    $item = $_POST["item"];

    //als item nog niet in winkelwagen zit, begin bij 1
    if (!isset($_SESSION[$item])) {
        $_SESSION[$item] = 1;
    } else {
        //anders aantal met 1 verhogen
        $_SESSION[$item]++;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Winkelwagen</title>
</head>

<body>

<h2>Producten</h2>

<?php foreach ($items as $item) { ?>

    <p>
        <?php echo $item["naam"]; ?>
        - €<?php echo $item["prijs"]; ?>

        <form method="POST">
            <input
                type="hidden"
                name="item"
                value="<?php echo $item["naam"]; ?>"
            >

            <button type="submit">
                Voeg toe
            </button>
        </form>
    </p>

<?php } ?>


<h2>Winkelwagen</h2>

<?php

//toon de huidige inhoud van de session
if (empty($_SESSION)) {

    echo "Winkelwagen is leeg.";

} else {

    foreach ($_SESSION as $item => $aantal) {
        echo $item . ": " . $aantal . "<br>";
    }
}

?>

</body>
</html>