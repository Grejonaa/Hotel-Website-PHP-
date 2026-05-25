<?php
include "../includes/db1.php";

header('Content-Type: text/plain');

if(isset($_POST['email'])){

    $email = trim($_POST['email']);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "INVALID";
        exit;
    }

    try {
        // check duplicate
        $check = $conn->prepare("SELECT id FROM subscribers WHERE email = ?");
        $check->execute([$email]);

        if($check->rowCount() > 0){
            echo "EXISTS";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO subscribers(email) VALUES(?)");
        $stmt->execute([$email]);

        echo "OK";

    } catch(Exception $e){
        echo "ERROR";
    }
}
?>