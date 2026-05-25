<link rel="stylesheet" href="admin.css">

<?php
include "../includes/db.php";
include "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    header("Location: reservations.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM projekt WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$reservation = $stmt->get_result()->fetch_assoc();

if (!$reservation) {
    die("Reservation not found.");
}
?>

<h1 class="page-title">Reservation Details</h1>

<table>

    <tr>
        <th>Name</th>
        <td><?= htmlspecialchars($reservation['NameSurname']); ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?= htmlspecialchars($reservation['Email']); ?></td>
    </tr>

    <tr>
        <th>Arrival</th>
        <td><?= $reservation['Arrival']; ?></td>
    </tr>

    <tr>
        <th>Departure</th>
        <td><?= $reservation['Departure']; ?></td>
    </tr>

    <tr>
        <th>Adults</th>
        <td><?= $reservation['Adults']; ?></td>
    </tr>

    <tr>
        <th>Children</th>
        <td><?= $reservation['Children']; ?></td>
    </tr>

    <tr>
        <th>Rooms</th>
        <td><?= $reservation['Rooms']; ?></td>
    </tr>

    <tr>
        <th>Room Type</th>
        <td><?= $reservation['TypeOfRoom']; ?></td>
    </tr>

</table>
