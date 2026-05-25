<?php

session_start();

require_once "../includes/db.php";


if(
    !isset($_SESSION["role"]) ||
    $_SESSION["role"] !== "admin"
){
    header("Location: ../pages/login.php");
    exit();
}

if(!isset($_GET["id"])){

    header("Location: rooms.php");
    exit();
}

$id = $_GET["id"];

$message = "";

$stmt = $conn->prepare(
    "SELECT * FROM rooms WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$room = $result->fetch_assoc();

if(!$room){

    header("Location: rooms.php");
    exit();
}

// UPDATE
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $room_name = trim($_POST["room_name"]);
    $room_type = trim($_POST["room_type"]);
    $price = trim($_POST["price"]);
    $description = trim($_POST["description"]);

    try{

        $updateStmt = $conn->prepare(
            "UPDATE rooms
            SET
                room_name = ?,
                room_type = ?,
                price = ?,
                description = ?
            WHERE id = ?"
        );

        $updateStmt->bind_param(
            "ssdsi",
            $room_name,
            $room_type,
            $price,
            $description,
            $id
        );

        if($updateStmt->execute()){

            header("Location: rooms.php");
            exit();

        } else {

            $message = "Update failed!";
        }

    }catch(Exception $e){

        $message = "Something went wrong!";
    }
}

include "../includes/header.php";
?>
<link rel="stylesheet" href="admin.css">

<div class="admin-form">

    <h1>Edit Room</h1>

    <form method="POST">

        <input
            type="text"
            name="room_name"
            value="<?php echo htmlspecialchars($room['room_name']); ?>"
            required
        >

        <input
            type="text"
            name="room_type"
            value="<?php echo htmlspecialchars($room['room_type']); ?>"
            required
        >

        <input
            type="number"
            step="0.01"
            name="price"
            value="<?php echo htmlspecialchars($room['price']); ?>"
            required
        >

        <textarea
            name="description"
        ><?php echo htmlspecialchars($room['description']); ?></textarea>

        <button type="submit">
            Update Room
        </button>

    </form>

    <p class="message">

        <?php echo htmlspecialchars($message); ?>

    </p>

</div>