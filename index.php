<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: auth/login.php");
    exit();
}
?>

<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php include "pages/home.php"; ?>

<?php include "includes/footer.php"; ?>