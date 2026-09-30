<?php

class ShoppingCart {

    private $items = [];

    //item toevoegen aan winkelwagen
    function addToCart($itemId) {

        if (isset($this->items[$itemId])) {
            $this->items[$itemId]++; //item zit er al in, dus aantal verhogen
        } else {
            $this->items[$itemId] = 1; //item wordt voor het eerst toegevoegd
        }
    }

    //inhoud van winkelwagen teruggeven
    function getCart() {
        return $this->items;
    }

    //winkelwagen leegmaken
    function emptyCart() {
        $this->items = [];
    }
}

?>