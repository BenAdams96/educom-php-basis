<?php

class Bear {

    public $name;
    public $age;
    public $weight;

    function __construct($name, $age, $weight) {
        $this->name = $name;
        $this->age = $age;
        $this->weight = $weight;
    }

    //informatie over de beer teruggeven
    function getInfo() {
        return "Name: " . $this->name .
            ", age: " . $this->age .
            ", weight: " . $this->weight . " kg";
    }
}


class Grizzly extends Bear {

    public $habitat;
    public $eats;

    function __construct($name, $age, $weight, $habitat, $eats) {

        //constructor van Bear gebruiken
        parent::__construct($name, $age, $weight);

        $this->habitat = $habitat;
        $this->eats = $eats;
    }

    function roars() {
        return true;
    }

    //extra informatie van de Grizzly
    function getGrizzlyInfo() {
        return "Leefgebied: " . $this->habitat;
    }
}

?>