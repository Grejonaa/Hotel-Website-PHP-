<?php

class Room {
    private $type;
    private $pricePerNight;

    public function __construct($type) {
        $this->type = $type;
        $this->setPrice();
    }

    private function setPrice() {
        if ($this->type === "economic") {
            $this->pricePerNight = 50;
        } else {
            $this->pricePerNight = 250;
        }
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
}