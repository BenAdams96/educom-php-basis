<?php

//upload map openen
if ($handle = opendir("upload/")) {

    echo "<h2>Bestanden</h2>";

    //alle bestanden uit de map lezen
    while (false !== ($entry = readdir($handle))) {

        //deze twee overslaan (huidige map en vorige map)
        if ($entry !== "." && $entry !== "..") {
            echo $entry . "<br>";
        }
    }

    closedir($handle);
}

?>