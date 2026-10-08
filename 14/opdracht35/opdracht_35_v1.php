<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //gegevens uit formulier halen
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $zipcode = $_POST["zipcode"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];

    //check of alle velden zijn ingevuld
    if (
        empty($firstname) || empty($lastname) || empty($address) ||
        empty($zipcode) || empty($phone_number) || empty($email)
    ) {
        $errors[] = "Vul alle velden in.";
    }

    //postcode controleren met regex
    $postcode_pattern = "/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/";

    if ($zipcode != "" && !preg_match($postcode_pattern, $zipcode)) {
        $errors[] = "Postcode is niet geldig.";
    }

    //telefoonnummer controleren met regex
    $phone_pattern = "/^(\+31|0)[0-9]{9}$/";

    if ($phone_number != "" && !preg_match($phone_pattern, $phone_number)) {
        $errors[] = "Telefoonnummer is niet geldig.";
    }

    //email controleren met regex
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if ($email != "" && !preg_match($email_pattern, $email)) {
        $errors[] = "E-mail is niet geldig.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulier validatie</title>
</head>

<body>

<h1>Gegevens invoeren</h1>

<form method="post" id="user_form" onsubmit="return validateForm()">

    <label>Voornaam:</label><br>
    <input type="text" name="firstname" id="firstname">
    <span id="firstname_error"></span> <!-- lege plek in HTML waar JS later tekst in kan zetten -->

    <br><br>

    <label>Achternaam:</label><br>
    <input type="text" name="lastname" id="lastname">
    <span id="lastname_error"></span>

    <br><br>

    <label>Adres:</label><br>
    <input type="text" name="address" id="address">
    <span id="address_error"></span>

    <br><br>

    <label>Postcode:</label><br>
    <input type="text" name="zipcode" id="zipcode">
    <span id="zipcode_error"></span>

    <br><br>

    <label>Telefoon:</label><br>
    <input type="text" name="phone_number" id="phone_number">
    <span id="phone_error"></span>

    <br><br>

    <label>E-mail:</label><br>
    <input type="text" name="email" id="email">
    <span id="email_error"></span>

    <br><br>

    <input type="submit" value="Versturen">
</form>

<script>

//velden ophalen
function getElement(id) {
    return document.getElementById(id);
}
//input velden ophalen
let firstname = getElement("firstname");//zijn de hele input velden die uit de html gehaald worden.
let lastname = getElement("lastname");
let address = getElement("address");
let zipcode = getElement("zipcode");
let phone_number = getElement("phone_number");
let email = getElement("email");

//foutmelding elementen ophalen
let firstname_error = getElement("firstname_error");
let lastname_error = getElement("lastname_error");
let address_error = getElement("address_error");
let zipcode_error = getElement("zipcode_error");
let phone_error = getElement("phone_error");
let email_error = getElement("email_error");

//regex patronen
let postcode_pattern = /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/;
let phone_pattern = /^(\+31|0)[0-9]{9}$/;
let email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

//postcode controleren na een "change" (nadat er een verandering is)
//eventlistener voor de zipcode (dus zipcode veld in html), die kijkt of er een verandering plaats vind
// zodra dit gebeurt, voert hij de code uit.
// dan in zipcode_error veld (die bepaald word met: <span id="zipcode_error"></span>)
// text plaatsen (via textContent). dus: zipcode_error.textContent =
// postcode_pattern.test(zipcode.value) betekend:
//  de zipcode.value (oftewel text in input veld), word gecheckt of die klopt aan de regex (postcode_pattern)
// zoja: dan ""     zoniet: dan "Ongeldige postcode"
zipcode.addEventListener("change", function () {
    zipcode_error.textContent =
        postcode_pattern.test(zipcode.value) ? "" : "Ongeldige postcode";
});
//telefoonnummer direct controleren
phone_number.addEventListener("change", function () {
phone_error.textContent = phone_pattern.test(phone_number.value) ? "" : " Ongeldig nummer";
});
//email direct controleren
email.addEventListener("change", function () {
email_error.textContent = email_pattern.test(email.value) ? "" : " Ongeldig e-mailadres";
});


//formulier controleren bij versturen
function validateForm() {

    let valid = true;

    //check voornaam
    if (firstname.value == "") {
        document.getElementById("firstname_error").textContent = " Vul voornaam in";
        valid = false;
    } else {
        document.getElementById("firstname_error").textContent = "";
    }

    //check achternaam
    if (lastname.value == "") {
        document.getElementById("lastname_error").textContent = " Vul achternaam in";
        valid = false;
    } else {
        document.getElementById("lastname_error").textContent = "";
    }

    //check adres
    if (address.value == "") {
        document.getElementById("address_error").textContent = " Vul adres in";
        valid = false;
    } else {
        document.getElementById("address_error").textContent = "";
    }

    //check postcode
    if (!postcode_pattern.test(zipcode.value)) {
        document.getElementById("zipcode_error").textContent = " Ongeldige postcode";
        valid = false;
    }

    //check telefoonnummer
    if (!phone_pattern.test(phone_number.value)) {
        document.getElementById("phone_error").textContent = " Ongeldig nummer";
        valid = false;
    }

    //check email
    if (!email_pattern.test(email.value)) {
        document.getElementById("email_error").textContent = " Ongeldig e-mailadres";
        valid = false;
    }

    return valid;
}

</script>

<?php


//als formulier is verstuurd en alles klopt
if ($_SERVER["REQUEST_METHOD"] == "POST" && $errors == []) {

    echo "<h2>Ingevoerde gegevens</h2>";

    echo "Voornaam: " . htmlspecialchars($firstname) . "<br>";
    echo "Achternaam: " . htmlspecialchars($lastname) . "<br>";
    echo "Adres: " . htmlspecialchars($address) . "<br>";
    echo "Postcode: " . htmlspecialchars($zipcode) . "<br>";
    echo "Telefoon: " . htmlspecialchars($phone_number) . "<br>";
    echo "E-mail: " . htmlspecialchars($email) . "<br>";
}

?>

</body>
</html>