<?php

session_start();

require "db.php";

//check of gebruiker is ingelogd
if (!isset($_SESSION["user"])) {
    header("Location: webshop_login.php");
    exit;
}

$userId = $_SESSION["user"]["id"];
$userNaam = $_SESSION["user"]["naam"];

//winkelwagen leegmaken
if (isset($_POST["reset"])) {

    $query = "DELETE FROM orders WHERE user_id = $userId";
    mysqli_query($connection, $query);

    header("Location: webshop.php");
    exit;
}

//check of er een item is toegevoegd
if (isset($_POST["item_id"])) {

    $itemId = $_POST["item_id"];

    //order toevoegen aan database
    $query = "INSERT INTO orders (user_id, item_id)
              VALUES ($userId, $itemId)";

    mysqli_query($connection, $query);

    //na POST opnieuw laden als gewone GET
    header("Location: webshop.php");
    exit;
}

//alle producten ophalen (NOTE: EXTRA CHECKEN)
$query = "SELECT * FROM items";
$itemsResult = mysqli_query($connection, $query);

//alle items uit winkelwagen ophalen
$query = "SELECT items.id, items.naam, items.prijs
          FROM orders
          JOIN items ON orders.item_id = items.id
          WHERE orders.user_id = $userId";

$cartResult = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Webshop</title>
</head>

<body>

    <h2>Welkom <?php echo $userNaam; ?></h2>

    <form action="webshop_login.php" method="POST">
        <button type="submit" name="logout">
            Uitloggen
        </button>
    </form>


    <h2>Producten</h2>

    <?php while ($item = mysqli_fetch_assoc($itemsResult)) { ?>

        <form method="POST">

            <?php
            echo $item["naam"] . " - €" . number_format($item["prijs"], 2);
            ?>

            <button
                type="submit"
                name="item_id"
                value="<?php echo $item["id"]; ?>"
            >
                Voeg toe
            </button>

        </form>

    <?php } ?>


    <h2>Winkelwagen</h2>

    <?php

    $winkelwagen = [];
    $totaalPrijs = 0;

    //producten uit orders verzamelen
    while ($item = mysqli_fetch_assoc($cartResult)) {

        $itemNaam = $item["naam"];
        $prijs = $item["prijs"];

        //als item nog niet in winkelwagen staat, begin bij 1
        if (!isset($winkelwagen[$itemNaam])) {

            $winkelwagen[$itemNaam] = [
                "prijs" => $prijs,
                "aantal" => 1
            ];

        } else {

            //anders aantal verhogen
            $winkelwagen[$itemNaam]["aantal"]++;
        }
    }

    //winkelwagen tonen
    foreach ($winkelwagen as $itemNaam => $item) {

        $prijs = $item["prijs"];
        $aantal = $item["aantal"];

        $itemTotaal = $prijs * $aantal;
        $totaalPrijs += $itemTotaal;

        echo $itemNaam . ": " . $aantal .
            " x €" . number_format($prijs, 2) .
            " = €" . number_format($itemTotaal, 2) . "<br>";
    }

    if (!empty($winkelwagen)) {

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