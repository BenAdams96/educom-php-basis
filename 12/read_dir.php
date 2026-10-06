<?php
//DEMO
if ($handle = opendir('./')) {
    echo "<b>Entries:</b> <br>";

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        echo $entry."<br>";
    }


    $files = scandir("./"); //eerst alles in lijst

    foreach ($files as $file) {
        echo $file . "<br>";
    }
    closedir($handle);
}
 
?>
