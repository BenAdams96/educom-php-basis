<?php

//extensie van bestand ophalen
function getExtension($file_name) {
    return strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
}

//checken of bestand een toegestane image extensie heeft
function isAllowedImage($file_name) {

    $extension = getExtension($file_name);

    if ($extension === "jpg" || $extension === "jpeg" || $extension === "png") {
        return true;
    }

    return false;
}


$dir = "upload";

//upload map openen
if ($handle = opendir($dir)) {

    echo "<b>Entries:</b><br><br>";

    //door alle bestanden in de map lopen
    while (false !== ($entry = readdir($handle))) {

        //de . en .. mappen overslaan
        if ($entry !== "." && $entry !== "..") {

            //alleen afbeeldingen laten zien
            if (isAllowedImage($entry)) {

                $file = $dir . "/" . $entry;

                //informatie van afbeelding ophalen
                $file_info = getimagesize($file);

                //thumbnail tonen, klik opent originele afbeelding
                echo "<a href='" . $file . "' target='_blank'>";
                echo "<img src='" . $file . "' width='100'>";
                echo "</a><br>";

                //informatie van afbeelding laten zien
                echo "Naam: " . $entry . "<br>";
                echo "Afmeting: " . $file_info[0] . " x " . $file_info[1] . "<br>";
                echo "Mime-type: " . $file_info["mime"] . "<br><br>";
            }
        }
    }

    closedir($handle);
}

?>