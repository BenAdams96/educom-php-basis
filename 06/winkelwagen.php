<?php

session_start();

$items = [
    "Appel" => 1.25,
    "Banaan" => 0.95,
    "Kiwi" => 1.10,
    "Meloen" => 2.99
];

//winkelwagen leegmaken
if (isset($_POST["reset"])) {
    session_unset();

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

//check of er een item is toegevoegd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];
    //als item nog niet in winkelwagen zit, begin bij 1
    if (!isset($_SESSION[$item])) {
        $_SESSION[$item] = 1;
    } else {
        //anders aantal met 1 verhogen
        $_SESSION[$item]++;
    }
    //na POST opnieuw laden als gewone GET
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Winkelwagen</title>
</head>

<body>

    <h2>Producten</h2>

    <?php foreach ($items as $itemNaam => $price) { ?>

        <form method="POST">
            <?php echo $itemNaam; ?>
            - €<?php echo $price; ?>

            <button type="submit" name="item" value="<?php echo $itemNaam; ?>">
                Voeg toe
            </button>
        </form>
    <?php } ?>


    <h2>Winkelwagen</h2>

    <?php

    $totaalPrijs = 0;

    foreach ($_SESSION as $itemNaam => $aantal) {

        $prijs = $items[$itemNaam];
        $itemTotaal = $prijs * $aantal;

        $totaalPrijs += $itemTotaal;

        echo $itemNaam . ": " . $aantal .
            " x €" . number_format($prijs, 2) .
            " = €" . number_format($itemTotaal, 2) . "<br>";
    }

    if (!empty($_SESSION)) {

        echo "<br>Totaal: €" . number_format($totaalPrijs, 2);
    ?>

        <form method="POST">
            <button type="submit" name="reset">
                Winkelwagen leegmaken
            </button>
        </form>

    <?php
    } else {
        echo "Winkelwagen is leeg.";
    }

    ?>


</body>

</html>