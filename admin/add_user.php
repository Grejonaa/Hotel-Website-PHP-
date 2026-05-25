<link rel="stylesheet" href="admin.css">

<?php
include "../includes/db.php";
include "../auth/auth_check.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("
        INSERT INTO users(fullname, email, password, role)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssss",
        $fullname,
        $email,
        $password,
        $role
    );

    $stmt->execute();

    header("Location: users.php");
    exit();
}
?>

<h1 class="page-title">Add User</h1>

<form class="admin-form" method="POST">

    <input type="text"
           name="fullname"
           placeholder="Full Name"
           required>

    <input type="email"
           name="email"
           placeholder="Email"
           required>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <input type="text"
           name="role"
           placeholder="Role"
           required>

    <button type="submit">Add User</button>

</form>