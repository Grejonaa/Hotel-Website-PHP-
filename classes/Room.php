<?php

class Room {

    private $type;
    private $pricePerNight;

    public function __construct($type) {
        $this->type = $type;
        $this->setPrice();
    }

    private function setPrice() {

        switch($this->type) {

            case "Classic":
                $this->pricePerNight = 120;
                break;

            case "superior":
                $this->pricePerNight = 250;
                break;

            case "family":
                $this->pricePerNight = 180;
                break;

            case "executive":
                $this->pricePerNight = 220;
                break;

            case "twin":
                $this->pricePerNight = 150;
                break;

            case "Grand_Deluxe":
                $this->pricePerNight = 240;
                break;

            case "Presidential_Suite":
                $this->pricePerNight = 500;
                break;

            default:
                $this->pricePerNight = 100;
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
?>