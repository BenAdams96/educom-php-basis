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

    //order van deze gebruiker zoeken
    $query = "SELECT id FROM orders WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
    $order = mysqli_fetch_assoc($result);

    if ($order) {
        $orderId = $order["id"];

        //alle items uit de order verwijderen
        $query = "DELETE FROM order_item WHERE order_id = $orderId";
        mysqli_query($connection, $query);
    }

    header("Location: webshop.php");
    exit;
}


//check of er een item is toegevoegd
if (isset($_POST["item_id"])) {

    $itemId = $_POST["item_id"];

    //kijken of gebruiker al een order heeft
    $query = "SELECT id FROM orders WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
    $order = mysqli_fetch_assoc($result);

    //als er nog geen order is, maak er een
    if (!$order) {

        $query = "INSERT INTO orders (user_id)
                  VALUES ($userId)";

        mysqli_query($connection, $query);

        $orderId = mysqli_insert_id($connection);

    } else {
        $orderId = $order["id"];
    }

    //kijken of item al in de order zit
    $query = "SELECT * FROM order_item
              WHERE order_id = $orderId
              AND item_id = $itemId";

    $result = mysqli_query($connection, $query);
    $orderItem = mysqli_fetch_assoc($result);

    if ($orderItem) {

        //item bestaat al, dus aantal verhogen
        $query = "UPDATE order_item
                  SET aantal = aantal + 1
                  WHERE order_id = $orderId
                  AND item_id = $itemId";

    } else {

        //item voor het eerst toevoegen
        $query = "INSERT INTO order_item (order_id, item_id, aantal)
                  VALUES ($orderId, $itemId, 1)";
    }

    mysqli_query($connection, $query);

    //na POST opnieuw laden als GET
    header("Location: webshop.php");
    exit;
}


//alle producten ophalen
$query = "SELECT * FROM items";
$itemsResult = mysqli_query($connection, $query);


//winkelwagen van deze gebruiker ophalen
$query = "SELECT items.naam, items.prijs, order_item.aantal
          FROM orders
          JOIN order_item ON orders.id = order_item.order_id
          JOIN items ON order_item.item_id = items.id
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
            echo $item["naam"] .
                " - €" .
                number_format($item["prijs"], 2);
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

    $totaalPrijs = 0;
    $winkelwagenLeeg = true;

    while ($item = mysqli_fetch_assoc($cartResult)) {

        $winkelwagenLeeg = false;

        $naam = $item["naam"];
        $prijs = $item["prijs"];
        $aantal = $item["aantal"];

        $itemTotaal = $prijs * $aantal;
        $totaalPrijs += $itemTotaal;

        echo $naam . ": " . $aantal .
            " x €" . number_format($prijs, 2) .
            " = €" . number_format($itemTotaal, 2) .
            "<br>";
    }


    if (!$winkelwagenLeeg) {

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