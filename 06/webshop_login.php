<?php

session_start();

require "db.php";

//uitloggen
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();

    header("Location: webshop_login.php");
    exit;
}

//als al ingelogd, naar webshop
if (isset($_SESSION["user"])) {
    header("Location: webshop.php");
    exit;
}

$melding = "";

//inloggen
if (isset($_POST["naam"])) {

    $naam = $_POST["naam"];

    $naam = mysqli_real_escape_string($connection, $naam);

    $query = "SELECT id, naam FROM user WHERE naam = '$naam'";
    $result = mysqli_query($connection, $query);

    $userData = mysqli_fetch_assoc($result);

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
    <title>Login</title>
</head>

<body>

    <h2>Login</h2>

    <form method="POST">
        Naam:
        <input type="text" name="naam">

        <button type="submit">
            Login
        </button>
    </form>

    <?php echo $melding; ?>

</body>

</html>