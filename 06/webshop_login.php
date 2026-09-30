<?php

session_start();

require "db.php";

//uitloggen
if (isset($_POST["logout"])) {
    session_unset();

    header("Location: webshop_login.php");
    exit;
}

//als user al ingelogd is, naar webshop
if (isset($_SESSION["user"])) {
    header("Location: webshop.php");
    exit;
}

$melding = "";

//inloggen
if (isset($_POST["login"])) {

    $naam = $_POST["naam"];

    //zoek gebruiker in database
    $query = "SELECT id, naam FROM user WHERE naam = '$naam'";
    $result = mysqli_query($connection, $query);

    $userData = mysqli_fetch_assoc($result);

    //als gebruiker bestaat
    if ($userData) {

        //user data opslaan in session
        $_SESSION["user"] = [
            "id" => $userData["id"],
            "naam" => $userData["naam"]
        ];

        header("Location: webshop.php");
        exit;

    } else {
        $melding = "Gebruiker niet gevonden.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Webshop login</title>
</head>

<body>

    <h2>Login</h2>

    <form method="POST">

        Naam:
        <input type="text" name="naam">

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <?php echo $melding; ?>

</body>

</html>