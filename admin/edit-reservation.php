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
    die("Reservation not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['NameSurname'];
    $email = $_POST['Email'];
    $arrival = $_POST['Arrival'];
    $departure = $_POST['Departure'];
    $adults = $_POST['Adults'];
    $children = $_POST['Children'];
    $rooms = $_POST['Rooms'];
    $type = $_POST['TypeOfRoom'];

    $update = $conn->prepare("
        UPDATE projekt 
        SET NameSurname=?, Email=?, Arrival=?, Departure=?, Adults=?, Children=?, Rooms=?, TypeOfRoom=? 
        WHERE id=?
    ");

    $update->bind_param(
        "ssssiiisi",
        $name,
        $email,
        $arrival,
        $departure,
        $adults,
        $children,
        $rooms,
        $type,
        $id
    );

    $update->execute();

    header("Location: reservations.php");
    exit();
}
?>

<h1 class="page-title">Edit Reservation</h1>

<form class="admin-form" method="POST">

    <input type="text"
           name="NameSurname"
           value="<?= $reservation['NameSurname']; ?>"
           required>

    <input type="email"
           name="Email"
           value="<?= $reservation['Email']; ?>"
           required>

    <input type="date"
           name="Arrival"
           value="<?= $reservation['Arrival']; ?>"
           required>

    <input type="date"
           name="Departure"
           value="<?= $reservation['Departure']; ?>"
           required>

    <input type="number"
           name="Adults"
           value="<?= $reservation['Adults']; ?>"
           required>

    <input type="number"
           name="Children"
           value="<?= $reservation['Children']; ?>"
           required>

    <input type="number"
           name="Rooms"
           value="<?= $reservation['Rooms']; ?>"
           required>

    <input type="text"
           name="TypeOfRoom"
           value="<?= $reservation['TypeOfRoom']; ?>"
           required>

    <button type="submit">Update Reservation</button>

</form>
