<?php

class Bear {

    private string $name;
    private int $age;
    private float $weight;

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

?>