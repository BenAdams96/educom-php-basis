<?php

$talen = ["Python", "PHP", "JavaScript", "C#", "Java", "Rust", "C++"];

sort($talen);

foreach ($talen as $key => $taal) {
    echo "$key: $taal" ."<br>";
}

// of

echo "[" . implode(", ", $talen) . "]";