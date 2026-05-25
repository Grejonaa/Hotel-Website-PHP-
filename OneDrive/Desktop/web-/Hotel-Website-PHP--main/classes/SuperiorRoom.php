<?php
require_once "Room.php";

class SuperiorRoom extends Room {

    public function __construct() {
        parent::__construct("Superior", 250);
    }

    // Override
    public function getDescription() {
        return "Superior Room - luks dhe komoditet maksimal.";
    }
}