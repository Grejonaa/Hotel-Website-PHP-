<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "forma";

try {

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        throw new Exception("Database connection failed");
    }

} catch (Exception $e) {

    die("Error: " . $e->getMessage());
}
?>