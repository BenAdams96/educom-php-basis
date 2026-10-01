<?php

include("Functions.php");

class User implements Functions {

    public int $id;
    public string $fileName;

    function __construct($id, $fileName) {
        $this->setId($id);
        $this->fileName = $fileName;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getId(): int{
        return $this->id;
    }

    function checkFileName(): bool{
        $extension = pathinfo($this->fileName, PATHINFO_EXTENSION); //manier om extension eruit te halen
        if ($extension == "jpg" || $extension == "png" || $extension == "gif") {
            return true;
        }

        return false;
    }
  
    function showImage() {
        if ($this->checkFileName()) { //check if we are dealing with an image
            return "<img src='" . $this->fileName . "' width='100' height='100'>";
        }

        return "Geen geldige afbeelding";
    }

    function showPassport() {
        return "ID: " . $this->getId() . "<br>" .
               $this->showImage() . "<br>";
    }
}

?>