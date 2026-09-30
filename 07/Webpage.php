<?php

class WebPage {

    public $title;

    //titel opslaan bij het maken van de pagina
    function __construct($title = "") {
        $this->title = $title;
    }

    //header functie
    function showHeader() {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>" . $this->title . "</title>";
        echo "</head>";
        echo "<body>";
    }

    //content laten zien
    function showContent($content) {
        echo "<p>" . $content . "</p>";
    }

    //pagina afsluiten
    function showFooter() {
        echo "</body>";
        echo "</html>";
    }
}

?>