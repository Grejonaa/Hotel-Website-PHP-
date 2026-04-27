<?php
require_once "Room.php";

class EconomicRoom extends Room {

    public function __construct() {
        parent::__construct("Economic", 50);
    }

    // Override
    public function getDescription() {
        return "Economic Room - më e lirë dhe praktike.";
    }
}