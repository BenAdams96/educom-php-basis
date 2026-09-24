<?php
function format_naw($name,$lastname,$adres,$postcode,$city)
{
    $output = "$name<br>" . "$lastname<br>" . "$adres<br>". "$postcode<br>". "$city<br>";
    return $output;
}

echo format_naw(
    "Frans",
    "Bouwmans",
    "Daalakkersweg 16",
    "5641 JA",
    "Eindhoven"
);
?>