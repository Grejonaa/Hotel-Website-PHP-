<?php
include "../includes/db.php";
include "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    die("ID missing");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM projekt WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: reservations.php");
    exit();
} else {
    echo "Error deleting reservation.";
}
?>
