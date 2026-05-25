<?php

$conn = new mysqli("localhost", "root", "", "forma");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
