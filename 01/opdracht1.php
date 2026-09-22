<?php
$naam = "Ben Adams";
$leeftijd = 29;
$woonplaats = "Breda";
$hobbies = array("voetbal", "basketbal", "tennis");
$overigeInformatie = "Is recent in Breda gaan wonen en is net begonnen aan het traineeship bij Educom.";

echo "Mijn naam is $naam.<br>";
echo "Ik ben $leeftijd jaar en woon in $woonplaats.<br><br>";

echo "Mijn hobbies zijn:<br>";
foreach ($hobbies as $key => $hobby) {
    echo "$key: $hobby<br>";
}

echo "<br>Overige informatie: $overigeInformatie";


