<?php

session_start();

//uitloggen (via de knop met een POST)
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

//loginformulier tonen
function show_form($error = "") {
    $form_data  = "<html><body>Please login:";
    if ($error != "") { //als verkeerde inlog word gebruikt
        $form_data .= "<br>" . $error . "<br>";
    }

    $form_data .= "<form action='login.php' method='POST'>";
    $form_data .= "Username:<input type='text' name='user'><br>";
    $form_data .= "Password:<input type='password' name='password'>";
    $form_data .= "<input type='submit' value='login'>";
    $form_data .= "</form></body></html>";

    echo $form_data;
}

//login controleren
function check_login($username, $password) {
    $mysqli = new mysqli("localhost", "root", "", "webshop"); //connect met de oude SQL webshop database via een object instantie

    if (mysqli_connect_errno()) { //als connectie error geeft
        echo "Connect failed: " . mysqli_connect_error();
        exit;
    }

    $query = "SELECT * FROM user 
              WHERE naam = '".$username."' 
              AND wachtwoord = '".$password."'";

    $result = $mysqli->query($query); // haal gebruikersnaam en WW op via de mysqli object/connectie

    if ($result->num_rows == 1) { //Als er (maar) 1 match is, dan return True
        return true;
    }

    return false;
}


//formulier is verstuurd (dus na indrukken knop 'login')
if (isset($_POST["user"]) && isset($_POST["password"])) {

    $user = $_POST["user"];
    $password = $_POST["password"];

    if (check_login($user, $password)) { //als dus de 1 gereturned word van functie hierboven
        $_SESSION["user"] = $user; //dan pas iets in de waarde SESSION doen, was al wel aangemaakt de SESSION
    } else {
        $error = "Verkeerde gebruikersnaam of wachtwoord.";
    }
}


//ingeloggen checken/ingelogd
if (isset($_SESSION["user"])) {
    echo "Ingelogd als " . $_SESSION["user"] . "<br><br>";
    echo "<form method='POST'>";
    echo "<button type='submit' name='logout'>Uitloggen</button>";
    echo "</form>";
} else {
    show_form($error ?? "");
}


?>