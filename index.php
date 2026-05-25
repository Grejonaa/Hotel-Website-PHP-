<?php
session_start();

// Kontrollo nëse user është i loguar
if (!isset($_SESSION["user"])) {
    header("Location: auth/login.php");
    exit();
}
?>

<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<!-- HOME PAGE -->
<?php include "pages/home.php"; ?>

<?php include "includes/footer.php"; ?>