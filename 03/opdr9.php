<?php

// 1. getallen 0 t/m 10
for ($i = 0; $i <= 10; $i++) {
    echo $i;

    if ($i < 10) {
        echo ", ";
    }
}

echo "<br><br>";

// 2. eerste 10 decimalen van pi
$pi = strval(M_PI);

$count = 0;

for ($i = 2; $count < 10; $i++) {
    echo $pi[$i];
    $count++;
    if ($count < 10) {
        echo ", ";
    }
}

echo "<br><br>";

// 2. Andere aanpak: substring + implode
$decimalen = substr($pi, 2, 10);
$decimalen_array = str_split($decimalen);
echo implode(", ", $decimalen_array)

?>

