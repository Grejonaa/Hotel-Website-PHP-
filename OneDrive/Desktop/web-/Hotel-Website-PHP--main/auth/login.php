<?php
session_start();
require_once "../classes/User.php";

$users = [
    new User("admin", "1234", "admin"),
    new User("user", "1234", "user")
];

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

   foreach ($users as $user) {
    if ($user->login($username, $password)) {

        $_SESSION["user"] = $user->getUsername();
        $_SESSION["role"] = $user->getRole();

        header("Location: ../index.php");
        exit();
    }
}

    $message = "Username ose password gabim!";
}
?>

<?php include "../includes/header.php"; ?>

<div class="login-container">
    <h2>Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <?php if ($message): ?>
        <p class="error-msg"><?php echo $message; ?></p>
    <?php endif; ?>
</div>