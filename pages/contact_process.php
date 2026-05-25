<?php

$errors = [];
$successMsg = "";

if (isset($_POST['send'])) {
$email = $_POST['email'];
$phone = $_POST['phone'];

$emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

$phoneRegex = "/^(\+383|0)[4-9][0-9]{7}$/";

if (!preg_match($emailRegex, $email)) {
$errors[] = "Email-i nuk eshte valid!";
}

if (!preg_match($phoneRegex, $phone)){
$errors[] = "Numri i telefonit duhet te jete valid!";
}

if (empty($errors)) {
$successMsg = "Mesazhi u dergua me sukses!";
}
}
?>