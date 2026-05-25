<?php
include "../includes/db.php";
include "../includes/header.php";
include "../includes/navbar.php";
include "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    die("Reservation ID missing.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM projekt WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$reservation = $result->fetch_assoc();

if (!$reservation) {
    die("Reservation not found.");
}
?>

<div class="container" style="margin-top:50px;">

    <h2>Reservation Details</h2>

    <p><strong>Name:</strong> <?php echo htmlspecialchars($reservation['NameSurname']); ?></p>

    <p><strong>Email:</strong> <?php echo htmlspecialchars($reservation['email']); ?></p>

    <p><strong>Arrival:</strong> <?php echo $reservation['arrival']; ?></p>

    <p><strong>Departure:</strong> <?php echo $reservation['departure']; ?></p>

    <p><strong>Adults:</strong> <?php echo $reservation['Adults']; ?></p>

    <p><strong>Children:</strong> <?php echo $reservation['Children']; ?></p>

    <p><strong>Rooms:</strong> <?php echo $reservation['Rooms']; ?></p>

    <p><strong>Room Type:</strong> <?php echo $reservation['TypeOfRoom']; ?></p>

</div>

<?php include "../includes/footer.php"; ?>
