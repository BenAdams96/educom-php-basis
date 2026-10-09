
<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //gegevens uit formulier halen
    $firstname = $_POST["firstname"] ?? "";
    $lastname = $_POST["lastname"] ?? "";
    $address = $_POST["address"] ?? "";
    $zipcode = $_POST["zipcode"] ?? "";
    $phone_number = $_POST["phone_number"] ?? "";
    $email = $_POST["email"] ?? "";

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

<?php
//php foutmeldingen tonen
foreach ($errors as $error) {
    echo "<p style='color:red'>" . htmlspecialchars($error) . "</p>";
}
?>

<!-- onsubmit="return validateForm()" tijdelijk uit om PHP te testen -->
<form method="post" id="user_form">

    <label>Voornaam:</label><br>
    <input type="text" name="firstname" id="firstname"
           value="<?= htmlspecialchars($firstname ?? '') ?>">
    <span id="firstname_error"></span>

    <br><br>

    <label>Achternaam:</label><br>
    <input type="text" name="lastname" id="lastname"
           value="<?= htmlspecialchars($lastname ?? '') ?>">
    <span id="lastname_error"></span>

    <br><br>

    <label>Adres:</label><br>
    <input type="text" name="address" id="address"
           value="<?= htmlspecialchars($address ?? '') ?>">
    <span id="address_error"></span>

    <br><br>

    <label>Postcode:</label><br>
    <input type="text" name="zipcode" id="zipcode"
           value="<?= htmlspecialchars($zipcode ?? '') ?>">
    <span id="zipcode_error"></span>

    <br><br>

    <label>Telefoon:</label><br>
    <input type="text" name="phone_number" id="phone_number"
           value="<?= htmlspecialchars($phone_number ?? '') ?>">
    <span id="phone_error"></span>

    <br><br>

    <label>E-mail:</label><br>
    <input type="text" name="email" id="email"
           value="<?= htmlspecialchars($email ?? '') ?>">
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
let firstname = getElement("firstname");
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

//postcode controleren na verandering
zipcode.addEventListener("change", function () {
    zipcode_error.textContent =
        postcode_pattern.test(zipcode.value) ? "" : "Ongeldige postcode";
});

//telefoonnummer controleren na verandering
phone_number.addEventListener("change", function () {
    phone_error.textContent =
        phone_pattern.test(phone_number.value) ? "" : "Ongeldig nummer";
});

//email controleren na verandering
email.addEventListener("change", function () {
    email_error.textContent =
        email_pattern.test(email.value) ? "" : "Ongeldig e-mailadres";
});

//formulier controleren bij versturen
function validateForm() {

    let valid = true;

    //check voornaam
    if (firstname.value == "") {
        firstname_error.textContent = " Vul voornaam in";
        valid = false;
    } else {
        firstname_error.textContent = "";
    }

    //check achternaam
    if (lastname.value == "") {
        lastname_error.textContent = " Vul achternaam in";
        valid = false;
    } else {
        lastname_error.textContent = "";
    }

    //check adres
    if (address.value == "") {
        address_error.textContent = " Vul adres in";
        valid = false;
    } else {
        address_error.textContent = "";
    }

    //check postcode
    if (!postcode_pattern.test(zipcode.value)) {
        zipcode_error.textContent = " Ongeldige postcode";
        valid = false;
    } else {
        zipcode_error.textContent = "";
    }

    //check telefoonnummer
    if (!phone_pattern.test(phone_number.value)) {
        phone_error.textContent = " Ongeldig nummer";
        valid = false;
    } else {
        phone_error.textContent = "";
    }

    //check email
    if (!email_pattern.test(email.value)) {
        email_error.textContent = " Ongeldig e-mailadres";
        valid = false;
    } else {
        email_error.textContent = "";
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
