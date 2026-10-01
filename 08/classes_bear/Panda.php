<?php

class Panda extends Bear {

    private int $bambooPerDay;

    function __construct($name, $age, $weight, $bambooPerDay) {
        parent::__construct($name, $age, $weight); //constructor van Bear gebruiken
        $this->bambooPerDay = $bambooPerDay;
    }

    function roars() {
        return False;
    }

    //extra informatie van de Grizzly
    function getPandaInfo() {
        // $this->getInfo();
        $bearInfo = $this->getInfo();
        //parent::getInfo(); //werkt niet
        return  $bearInfo . "<br>Bamboo per day: " . $this->bambooPerDay;
    }
}


?>