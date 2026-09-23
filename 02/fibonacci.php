<?php

$first_value = 0;
$second_value = 1;

for ($i = 0; $i < 22; $i++) {
    echo $first_value . ", ";
    $next_value = $first_value + $second_value;
    $first_value = $second_value;
    $second_value = $next_value;
}
