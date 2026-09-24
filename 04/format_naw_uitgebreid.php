<?php
function format_naw($name = "Tim",$lastname="De Jong",$adres="dorpstraat",$postcode="1234AB",$city="Amsterdam")
{
    $output = "$name<br>" . "$lastname<br>" . "$adres<br>". "$postcode<br>". "$city<br>";
    return $output;
}

echo format_naw();
//NOTE TO SELF: eerst alle variabelen in de functie zonder een default, daarna met een default waarde.
?>