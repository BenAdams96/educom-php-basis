<?php

$message = "";

//check of formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //postcode uit formulier halen
    $zipcode = $_POST["zipcode"];

    //regex: 4 cijfers, optionele spatie, 2 letters
    $pattern = "/^[1-9]{1}[0-9]{3}\s?[a-zA-Z]{2}$/"; // \s betekend white space, ? betekend vorige onderdeel mag 0 of 1 keer voorkomen

    //check of postcode klopt met regex
    if (preg_match($pattern, $zipcode)) {
        $message = htmlspecialchars($zipcode) . " is een geldige postcode!";
    } elseif (!preg_match($pattern, $zipcode) && $zipcode != "") { //kijken of string voldoet aan regex regels
        $message = htmlspecialchars($zipcode) . " is geen geldige postcode!";
    } else {
        $message = "Vul een postcode in!"; 
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Postcode check</title>
</head>

<body>

    <h1>Postcode controleren</h1>

    <form method="post">

        <label>Postcode:</label><br>
        <input type="text" name="zipcode">

        <br><br>

        <input type="submit" value="Controleren">

    </form>

    <?php

    //melding laten zien
    if ($message != "") {
        echo "<p>" . $message . "</p>";
    }

    ?>

</body>

</html>