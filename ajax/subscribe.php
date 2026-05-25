<?php
include "../includes/db1.php";

header('Content-Type: text/plain');

try {

    if (!isset($_POST['email'])) {
        echo "ERROR";
        exit;
    }

    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "INVALID";
        exit;
    }

    // CHECK DUPLICATE (correct table name)
    $check = $conn->prepare("SELECT Id FROM subscribe WHERE Email = ?");
    $check->execute([$email]);

    if ($check->fetchColumn()) {
        echo "EXISTS";
        exit;
    }

    // INSERT
    $stmt = $conn->prepare("INSERT INTO subscribe (Email) VALUES (?)");
    $stmt->execute([$email]);

    echo "OK";

} catch (PDOException $e) {
    echo "ERROR";
}
?>