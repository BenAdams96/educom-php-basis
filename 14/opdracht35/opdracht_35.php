<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //gegevens uit formulier halen
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $zipcode = $_POST["zipcode"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    //check of alle velden zijn ingevuld
    if (empty($firstname) || empty($lastname) || empty($address) ||
        empty($zipcode) || empty($phone) || empty($email))
    {$error = "Vul alle velden in.";}

    //postcode controleren met regex

    //telefoonnummer controleren met regex

    //email controleren

    //als er fouten zijn
    //foutmelding laten zien

    //als alles klopt
    //gegevens laten zien
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulier validatie</title>
</head>

<body>

    <h1>Gegevens invoeren</h1>

    <form method="post">

        <label>Voornaam:</label><br>
        <input type="text" name="firstname">

        <br><br>

        <label>Achternaam:</label><br>
        <input type="text" name="lastname">

        <br><br>

        <label>Adres:</label><br>
        <input type="text" name="address">

        <br><br>

        <label>Postcode:</label><br>
        <input type="text" name="zipcode">

        <br><br>

        <label>Telefoon:</label><br>
        <input type="text" name="phone">

        <br><br>

        <label>E-mail:</label><br>
        <input type="text" name="email">

        <br><br>

        <input type="submit" value="Versturen">

    </form>

    <?php

    //als formulier is verstuurd en alles klopt
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //gegevens laten zien
        echo "<h2>Ingevoerde gegevens</h2>";

        echo "Voornaam: " . htmlspecialchars($firstname) . "<br>";
        echo "Achternaam: " . htmlspecialchars($lastname) . "<br>";
        echo "Adres: " . htmlspecialchars($address) . "<br>";
        echo "Postcode: " . htmlspecialchars($zipcode) . "<br>";
        echo "Telefoon: " . htmlspecialchars($phone) . "<br>";
        echo "E-mail: " . htmlspecialchars($email) . "<br>";
    }

    ?>

</body>

</html>