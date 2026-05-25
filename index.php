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
<?php if (isset($_SESSION["user"])): ?>
    <div class="welcome-box">
    Welcome, <?php echo htmlspecialchars($_SESSION["fullname"]); ?>
    </div>
<?php endif; ?>

<!-- HOME PAGE -->
<?php include "pages/home.php"; ?>

<?php include "includes/footer.php"; ?>