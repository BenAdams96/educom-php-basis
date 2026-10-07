<?php

$message = "";

//check of formulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //postcode uit formulier halen
    $zipcode = $_POST["zipcode"];

    //regex: 4 cijfers, optionele spatie, 2 letters
    $pattern = "/^[0-9]{4}\s?[a-zA-Z]{2}$/";

    //check of postcode klopt met regex
    if (preg_match($pattern, $zipcode)) {
        $message = "Geldige postcode";
    } else {
        $message = "Ongeldige postcode";
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