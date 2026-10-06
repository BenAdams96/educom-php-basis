<?php

//checken of er een bestand is verstuurd
if (isset($_FILES["file"])) {

    //informatie uit $_FILES halen
    $file_name = $_FILES["file"]["name"];
    $file_size = $_FILES["file"]["size"];
    $file_type = $_FILES["file"]["type"];
    $temp_name = $_FILES["file"]["tmp_name"];
    $error = $_FILES["file"]["error"];

    $allowed = true;

    //checken wat alles in _FILES
    var_dump($_FILES["file"]);
    echo "<br>";
    //checken of upload goed is gegaan
    if ($error === UPLOAD_ERR_OK) { //upload_err_ok is ingebouwde php constante === 0
        echo "uploaded correctly <br>";
    } else {
        echo "uploaded incorrectly <br>";
        $allowed = false;
    }

    //maximale bestandsgrootte controleren
    if ($file_size < 1 * 1000 * 1000) {
        echo "smaller than 1MB <br>";
    } else {
        echo "bigger than 1MB <br>";
        $allowed = false;
    }

    //TODO controleren of het een toegestaan image-type is
    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if ($extension === "jpg" || $extension === "jpeg" || $extension === "png") {
        echo "allowed image type";
    } else {
        echo "not allowed";
        $allowed = false;
    } //! Q: mime-type hier gebruiken is eigenlijk beter? ("type" gebruiken dus)

    //alleen bestand opslaan als alle controles goed zijn
    if ($allowed) {

        //originele bestandsnaam gebruiken
        $destination = "upload/" . $file_name;

        //als bestand al bestaat, unieke naam maken
        if (file_exists($destination)) { //check of file bestaat, zo ja, new name geven
            $new_name = uniqid() . "." . $extension; //in productie beter: $new_name = bin2hex(random_bytes(16)) . "." . $extension;
            $destination = "upload/" . $new_name;
        }

        //bestand van tijdelijke locatie naar upload map verplaatsen
        move_uploaded_file($temp_name, $destination);

        echo "<br>file uploaded";
    }
}
