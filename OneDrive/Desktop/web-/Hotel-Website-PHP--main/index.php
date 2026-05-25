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

<!-- DASHBOARD sipas rolit -->
<div style="padding-top:60px; text-align:center;">
    
    <h1>Mirësevjen, <?php echo $_SESSION["user"]; ?></h1>

    <?php if ($_SESSION["role"] === "admin"): ?>
        <h2>Admin Dashboard</h2>
        <p>Ju keni akses të plotë në sistem.</p>

    <?php else: ?>
        <h2>User Dashboard</h2>
        <p>Ju mund të bëni rezervime dhe të shikoni dhomat.</p>
    <?php endif; ?>

</div>

<!-- HOME PAGE -->
<?php include "pages/home.php"; ?>

<?php include "includes/footer.php"; ?>