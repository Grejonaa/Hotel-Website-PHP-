<?php
session_start();

require_once "../classes/User.php";

// Dummy users vetem per demonstrim
$users = [
    new User("admin", "1234", "admin"),
    new User("user", "1234", "user")
];

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    foreach ($users as $user) {
        if (
            $user->getUsername() === $username &&
            $user->getPassword() === $password
        ) {
            $_SESSION["user"] = $user->getUsername();
            $_SESSION["role"] = $user->getRole();

            header("Location: ../index.php");
            exit();
        }
    }

    $message = "Username ose password gabim!";
}
?>

<h2>Login</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<p style="color:red;"><?php echo $message; ?></p>