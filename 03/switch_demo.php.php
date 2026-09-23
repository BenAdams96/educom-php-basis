<?php

$keuze = "";
$tekst = "";

//als er iets via GET is verstuurd
if ($_GET) {

    $keuze = $_GET["dier"];

    //kijk welke keuze is gemaakt
    switch ($keuze) {

        case "hond":
            $tekst = "Je hebt een hond gekozen.";
            break;

        case "kat":
            $tekst = "Je hebt een kat gekozen.";
            break;

        case "papegaai":
            $tekst = "Je hebt een papegaai gekozen.";
            break;

        default:
            $tekst = "Onbekende keuze.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Switch demo</title>
</head>

<body>

    <!-- simpel keuzeformulier -->
    <form method="GET">
        <select name="dier">
            <option value="hond">Hond</option>
            <option value="kat">Kat</option>
            <option value="papegaai">Papegaai</option>
        </select>

        <button type="submit">Kies</button>

    </form>

    <?php
    //toont resultaat pas na een keuze
    echo $tekst;
    ?>
</body>

</html>