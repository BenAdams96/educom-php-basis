<?php

class GameCharacter {

    public $name;
    public $health;
    public $armor;

    function __construct($name, $health, $armor) {
        $this->name = $name;
        $this->health = $health;
        $this->armor = $armor;
    }

    function attack() {
        echo $this->name . " attacks.<br>";
        //code to do an attack
    }
}

class Mage extends GameCharacter {

    function castSpell() {
        echo $this->name . " uses a spell.";
        //Code to cast a spell
    }
}

$character = new Mage("Gandalf", 100, 10);

$character->attack();
$character->castSpell();

?>