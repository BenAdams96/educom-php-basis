<?php

class Grizzly extends Bear {

    private int $clawLength;

    function __construct($name, $age, $weight, $clawLength) {
        parent::__construct($name, $age, $weight); //constructor van Bear gebruiken
        $this->clawLength = $clawLength;
    }

    function roars() {
        return True;
    }

    //extra informatie van de Grizzly
    function getGrizzlyInfo() {
        return "clawlength: " . $this->clawLength;
    }
}


?>