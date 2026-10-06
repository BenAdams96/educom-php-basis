<?php

session_start();

require("DBConnect.php");
require("User.php");

//database connectie ophalen
$db_connection = DBConnect::getInstance();

//user object maken en connectie meegeven
$user = new User($db_connection);

//uitloggen
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

//login/aanmelden formulier tonen
function show_form($error = "") {

    $form_data = "<html><body>";

    if ($error != "") {
        $form_data .= $error . "<br><br>";
    }

    //login formulier
    $form_data .= "<h2>Login</h2>";
    $form_data .= "<form method='POST'>";
    $form_data .= "Username:<input type='text' name='username'><br>";
    $form_data .= "Password:<input type='password' name='password'><br>";
    $form_data .= "<input type='hidden' name='action' value='login'>";
    $form_data .= "<input type='submit' value='Login'>";
    $form_data .= "</form>";

    //aanmelden formulier (extra toegevoegd)
    $form_data .= "<h2>Aanmelden</h2>";
    $form_data .= "<form method='POST'>";
    $form_data .= "Username:<input type='text' name='username'><br>";
    $form_data .= "Password:<input type='password' name='password'><br>";
    $form_data .= "<input type='hidden' name='action' value='register'>";

    //input type 'submit' verstuurt alles binnen de form die een name hebben
    $form_data .= "<input type='submit' value='Aanmelden'>";
    //!:
    //maar dat is nu ook de naam van de knop.
    //mocht je dat anders willen, dan <button>
    //<button type="submit" name="action" value="register">Aanmelden</button>

    //button type submit verstuurt het formulier
    //tekst tussen <button> en </button> komt op de knop
    //value wordt meegestuurd naar PHP
    //hier wordt dus action = register verstuurd

    $form_data .= "</form>";

    $form_data .= "</body></html>";

    echo $form_data;
}


//formulier is verstuurd
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["username"], $_POST["password"], $_POST["action"])
) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    //bepalen welk formulier is gebruikt
    switch ($_POST["action"]) {
        case "login":
            //user zoeken via User class
            $result = $user->getUser($username, $password);
            if ($result) {
                $_SESSION["user"] = $result->naam;
            } else {
                $error = "Verkeerde gebruikersnaam of wachtwoord.";
            }
            break;
        case "register":

            //nieuwe user toevoegen
            $user->insertUser($username, $password);

            //na aanmelden meteen inloggen
            $result = $user->getUser($username, $password);
            if ($result) {
                $_SESSION["user"] = $result->naam;
            }
            break;
    }
}


//checken of user is ingelogd
if (isset($_SESSION["user"])) {

    echo "Ingelogd als " . $_SESSION["user"] . "<br><br>";

    echo "<form method='POST'>";
    echo "<button type='submit' name='logout'>Uitloggen</button>";
    echo "</form>";

} else {

    show_form($error ?? "");
}

?>