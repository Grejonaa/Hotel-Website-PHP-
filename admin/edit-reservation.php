<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/navbar.php";
include "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    die("ID missing");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM projekt WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$reservation = $result->fetch_assoc();

if (!$reservation) {
    die("Reservation not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['NameSurname'];
    $email = $_POST['email'];
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];
    $adults = $_POST['Adults'];
    $children = $_POST['Children'];
    $rooms = $_POST['Rooms'];
    $type = $_POST['TypeOfRoom'];

    $update = $conn->prepare("UPDATE projekt 
        SET NameSurname=?, email=?, arrival=?, departure=?, Adults=?, Children=?, Rooms=?, TypeOfRoom=? 
        WHERE id=?");

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

    if ($update->execute()) {
        header("Location: reservations.php");
        exit();
    }
}
?>

<div class="container" style="margin-top:50px;">

<h2>Edit Reservation</h2>

<form method="POST">

    <input type="text" name="NameSurname"
           value="<?php echo $reservation['NameSurname']; ?>" required><br><br>

    <input type="email" name="email"
           value="<?php echo $reservation['email']; ?>" required><br><br>

    <input type="date" name="arrival"
           value="<?php echo $reservation['arrival']; ?>" required><br><br>

    <input type="date" name="departure"
           value="<?php echo $reservation['departure']; ?>" required><br><br>

    <input type="number" name="Adults"
           value="<?php echo $reservation['Adults']; ?>" required><br><br>

    <input type="number" name="Children"
           value="<?php echo $reservation['Children']; ?>" required><br><br>

    <input type="number" name="Rooms"
           value="<?php echo $reservation['Rooms']; ?>" required><br><br>

    <input type="text" name="TypeOfRoom"
           value="<?php echo $reservation['TypeOfRoom']; ?>" required><br><br>

    <button type="submit">Update Reservation</button>

</form>

</div>

<?php include "../includes/footer.php"; ?>
