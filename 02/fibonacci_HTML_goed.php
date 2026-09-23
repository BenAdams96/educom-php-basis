<?php

$first_value = 0;
$second_value = 1;
$output = "";

for ($i = 0; $i < 22; $i++) {
    $output .= $first_value;

    if ($i < 21) {
        $output .= ", ";
    }

    $next_value = $first_value + $second_value;
    $first_value = $second_value;
    $second_value = $next_value;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci</title>
</head>
<body>

    <h2>Fibonacci</h2>
    <p><?php echo $output; ?></p>

</body>
</html>