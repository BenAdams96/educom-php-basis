<?php

$pets = [
    "nummer1" => "Griffioen",
    "nummer2" => "Draak",
    "nummer3" => "Eenhoorn",
    "nummer4" => "BigFoot"
];

foreach ($pets as $key => $value) {
    echo $key . ": " . $value . "<br>";
}