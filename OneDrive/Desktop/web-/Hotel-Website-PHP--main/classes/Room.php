<?php

class Room {
    protected $type;
    protected $pricePerNight;

    public function __construct($type, $pricePerNight) {
        $this->type = $type;
        $this->pricePerNight = $pricePerNight;
    }

    public function calculateTotal($rooms, $nights) {
        return $rooms * $nights * $this->pricePerNight;
    }

    public function getType() {
        return $this->type;
    }

    public function getPrice() {
        return $this->pricePerNight;
    }

    // Setter (encapsulation)
    public function setPrice($price) {
        $this->pricePerNight = $price;
    }
}