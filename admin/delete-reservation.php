<?php
include "../includes/db.php";
include "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    header("Location: reservations.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM projekt WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: reservations.php");
exit();
?>
