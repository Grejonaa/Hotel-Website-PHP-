<link rel="stylesheet" href="admin.css">
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

try{

    $stmt = $conn->prepare(
        "DELETE FROM rooms WHERE id = ?"
    );

    $stmt->bind_param("i", $id);

    $stmt->execute();

}catch(Exception $e){

    echo "Something went wrong!";
}

header("Location: rooms.php");
exit();
?>