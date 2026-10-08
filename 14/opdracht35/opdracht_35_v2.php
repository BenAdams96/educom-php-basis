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
    $phone_number_pattern = "/^(\+31|0)[0-9]{9}$/";

    if ($phone_number != "" && !preg_match($phone_number_pattern, $phone_number)) {
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
        <span id="phone_number_error"></span>

        <br><br>

        <label>E-mail:</label><br>
        <input type="text" name="email" id="email">
        <span id="email_error"></span>

        <br><br>

        <input type="submit" value="Versturen">
    </form>

    <script>
        //input velden ophalen
        const firstname = getElement("firstname");
        const lastname = getElement("lastname");
        const address = getElement("address");
        const zipcode = getElement("zipcode");
        const phone_number = getElement("phone_number");
        const email = getElement("email");

        //foutmelding velden ophalen
        const zipcode_error = getElement("zipcode_error");
        const phone_number_error = getElement("phone_number_error");
        const email_error = getElement("email_error");

        const postcode_pattern = /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/;
        const phone_number_pattern = /^(\+31|0)[0-9]{9}$/;
        const email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        //element ophalen uit html
        function getElement(id) {
            return document.getElementById(id);
        }

        //veld controleren met regex
        function validateField(field, errorField, pattern, errorMessage) {
            const valid = pattern.test(field.value);
            errorField.textContent = valid ? "" : errorMessage;
            return valid;
        }

        //postcode controleren
        zipcode.addEventListener("change", function() {
            validateField(
                zipcode,
                zipcode_error,
                postcode_pattern,
                "Ongeldige postcode"
            );
        });

        //telefoonnummer controleren
        phone_number.addEventListener("change", function() {
            validateField(
                phone_number,
                phone_number_error,
                phone_number_pattern,
                "Ongeldig telefoonnummer"
            );
        });

        //email controleren
        email.addEventListener("change", function() {
            validateField(
                email,
                email_error,
                email_pattern,
                "Ongeldig e-mailadres"
            );
        });

        //check of verplicht veld is ingevuld
        function validateRequired(field, errorMessage) {

            const errorField = getElement(field.id + "_error");

            if (field.value.trim() == "") {
                errorField.textContent = errorMessage;
                return false;
            }

            errorField.textContent = "";
            return true;
        }
        //postcode controleren na een "change" (nadat er een verandering is)
        //eventlistener voor de zipcode (dus zipcode veld in html), die kijkt of er een verandering plaats vind
        // zodra dit gebeurt, voert hij de code uit.
        // dan in zipcode_error veld (die bepaald word met: <span id="zipcode_error"></span>)
        // text plaatsen (via textContent). dus: zipcode_error.textContent =
        // postcode_pattern.test(zipcode.value) betekend:
        //  de zipcode.value (oftewel text in input veld), word gecheckt of die klopt aan de regex (postcode_pattern)
        // zoja: dan ""     zoniet: dan "Ongeldige postcode"


        function validateForm() { //JS client-side check.
            //check voor elk veld of het juist is

            let valid = true;

            const requiredFields = [
                [firstname, "Vul voornaam in"],
                [lastname, "Vul achternaam in"],
                [address, "Vul adres in"],
                [zipcode, "Vul postcode in"],
                [phone_number, "Vul telefoonnummer in"],
                [email, "Vul e-mailadres in"]
            ];

            //verplichte velden controleren
            for (const [field, message] of requiredFields) {
                if (!validateRequired(field, message)) {
                    valid = false;
                }
            }

            const patternFields = [
                [zipcode, zipcode_error, postcode_pattern, "Ongeldige postcode"],
                [phone_number, phone_number_error, phone_number_pattern, "Ongeldig telefoonnummer"],
                [email, email_error, email_pattern, "Ongeldig e-mailadres"]
            ];

            //velden met regex controleren
            for (const [field, errorField, pattern, message] of patternFields) {

                //alleen regex checken als veld is ingevuld
                if (
                    field.value != "" &&
                    !validateField(field, errorField, pattern, message)
                ) {
                    valid = false;
                }
            }

            return valid;
        }
    </script>

    <?php


    //als formulier is verstuurd en alles klopt
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {

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