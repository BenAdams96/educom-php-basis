<?php

$file_name = "library.xml";

if (file_exists($file_name)) {
    //xml bestand inladen
    $xml_doc = simplexml_load_file($file_name);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Library</title>
    </head>
    <body>

    <h1>Library</h1>

    <?php
    //door alle boeken heen met foreach loop
    foreach ($xml_doc as $book) {

        //gegevens van boek laten zien
        echo "<h2>" . $book->title . "</h2>";
        echo "<p><b>ISBN:</b> " . $book->isbn . "<br>";
        echo "<b>Publisher:</b> " . $book->publisher . "<br>";
        echo "<b>Price:</b> €" . $book->price . "<br>";
        echo "<b>Publication date:</b> " . $book->pubdate . "</p>";

        echo "<b>Authors:</b><br>";

        foreach ($book->authors->author as $author) {
            echo "- " . $author . "<br>";
        }
        echo "<hr>";
        
    }
    ?>

    </body>
    </html>

    <?php
} else {
    echo "File " . $file_name . " not found";
}

?>