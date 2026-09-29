<?php

session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "webshop";

//verbinding met database
$connection = mysqli_connect($host, $user, $password, $dbname);


//uitloggen
if (isset($_POST["logout"])) {
    session_unset();

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}


//inloggen
if (isset($_POST["login"])) {

    $naam = $_POST["naam"];

    //zoek gebruiker met deze naam
    $stmt = mysqli_prepare(
        $connection,
        "SELECT id, naam FROM user WHERE naam = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $naam);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $gevondenUser = mysqli_fetch_assoc($result);

    //als user bestaat, sla gegevens op in session
    if ($gevondenUser) {
        $_SESSION["user_id"] = $gevondenUser["id"];
        $_SESSION["user_naam"] = $gevondenUser["naam"];

        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    } else {
        $loginFout = "Gebruiker niet gevonden.";
    }
}


//item toevoegen aan orders
if (isset($_POST["item_id"]) && isset($_SESSION["user_id"])) {

    $userId = $_SESSION["user_id"];
    $itemId = $_POST["item_id"];

    //nieuwe order toevoegen
    $stmt = mysqli_prepare(
        $connection,
        "INSERT INTO orders (user_id, item_id) VALUES (?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "ii", $userId, $itemId);
    mysqli_stmt_execute($stmt);

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Webshop</title>
</head>

<body>

<?php

//stap 2: check of gebruiker is ingelogd
if (!isset($_SESSION["user_id"])) {

?>

    <h2>Login</h2>

    <form method="POST">

        Naam:
        <input type="text" name="naam">

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <?php
    if (isset($loginFout)) {
        echo $loginFout;
    }

} else {

    echo "<h2>Welkom " . $_SESSION["user_naam"] . "</h2>";

    ?>

    <form method="POST">
        <button type="submit" name="logout">
            Uitloggen
        </button>
    </form>


    <h2>Items</h2>

    <?php

    //stap 3: haal alle items uit database
    $result = mysqli_query($connection, "SELECT * FROM items");

    while ($item = mysqli_fetch_assoc($result)) {

        ?>

        <form method="POST">

            <?php
            echo $item["naam"] . " - €" . $item["prijs"];
            ?>

            <button
                type="submit"
                name="item_id"
                value="<?php echo $item["id"]; ?>"
            >
                Voeg toe
            </button>

        </form>

        <?php
    }
}

?>

</body>
</html>