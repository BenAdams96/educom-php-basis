<?php

include("classes_shopping_cart.php");

session_start();

$products = [
    1 => ["naam" => "Appel", "prijs" => 1.25],
    2 => ["naam" => "Banaan", "prijs" => 0.95],
    3 => ["naam" => "Kiwi", "prijs" => 1.10],
    4 => ["naam" => "Meloen", "prijs" => 2.99]
];

//als er nog geen winkelwagen bestaat, maak er een
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = new ShoppingCart();
}

$cart = $_SESSION["cart"];

//winkelwagen leegmaken
if (isset($_POST["reset"])) {
    $cart->emptyCart();

    header("Location: show_shopping_cart.php");
    exit;
}

//item toevoegen
if (isset($_POST["item"])) {
    $itemId = $_POST["item"];

    $cart->addToCart($itemId);

    header("Location: show_shopping_cart.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart OOP</title>
</head>

<body>

    <h2>Producten</h2>

    <?php foreach ($products as $itemId => $product) { ?>

        <form method="POST">

            <?php echo $product["naam"]; ?>
            - €<?php echo number_format($product["prijs"], 2); ?>

            <button type="submit" name="item" value="<?php echo $itemId; ?>">
                Voeg toe
            </button>

        </form>

    <?php } ?>


    <h2>Winkelwagen</h2>

    <?php

    $items = $cart->getCart();
    $totaalPrijs = 0;

    foreach ($items as $itemId => $aantal) {

        $naam = $products[$itemId]["naam"];
        $prijs = $products[$itemId]["prijs"];

        $itemTotaal = $prijs * $aantal;
        $totaalPrijs += $itemTotaal;

        echo $naam . ": " . $aantal .
            " x €" . number_format($prijs, 2) .
            " = €" . number_format($itemTotaal, 2) . "<br>";
    }

    if (!empty($items)) {

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