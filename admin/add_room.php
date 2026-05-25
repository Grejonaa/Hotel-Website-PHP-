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

$message = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $room_name = trim($_POST["room_name"]);
    $room_type = trim($_POST["room_type"]);
    $price = trim($_POST["price"]);
    $description = trim($_POST["description"]);

    $imageName = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $finalImageName = time() . "_" . $imageName;
    $uploadPath = "../uploads/" . $finalImageName;

    try{

        if(move_uploaded_file($tmpName, $uploadPath)){

            $stmt = $conn->prepare(
                "INSERT INTO rooms
                (room_name, room_type, price, description, image)
                VALUES(?,?,?,?,?)"
            );

            $stmt->bind_param(
                "ssdss",
                $room_name,
                $room_type,
                $price,
                $description,
                $finalImageName
            );

            if($stmt->execute()){
                header("Location: rooms.php");
                exit();
            } else {
                $message = "Failed to add room!";
            }

        } else {
            $message = "Image upload failed!";
        }

    } catch(Exception $e){
        $message = "Something went wrong!";
    }
}

include "../includes/header.php";
?>

<link rel="stylesheet" href="admin.css">

<h1 class="page-title">Add Room</h1>

<form method="POST" enctype="multipart/form-data" class="admin-form">

    <input type="text" name="room_name" placeholder="Room Name" required>

    <input type="text" name="room_type" placeholder="Room Type" required>

    <input type="number" step="0.01" name="price" placeholder="Price" required>

    <textarea name="description" placeholder="Description"></textarea>

    <input type="file" name="image" required>

    <button type="submit">Add Room</button>

</form>

<?php if($message != ""): ?>
    <p class="message">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>