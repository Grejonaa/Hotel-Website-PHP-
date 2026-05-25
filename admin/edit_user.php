<link rel="stylesheet" href="admin.css">

<?php
include "../includes/db.php";
include "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("User not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update = $conn->prepare("
        UPDATE users
        SET fullname=?, email=?, role=?
        WHERE id=?
    ");

    $update->bind_param(
        "sssi",
        $fullname,
        $email,
        $role,
        $id
    );

    $update->execute();

    header("Location: users.php");
    exit();
}
?>

<h1 class="page-title">Edit User</h1>

<form class="admin-form" method="POST">

    <input type="text"
           name="fullname"
           value="<?= $user['fullname']; ?>"
           required>

    <input type="email"
           name="email"
           value="<?= $user['email']; ?>"
           required>

    <input type="text"
           name="role"
           value="<?= $user['role']; ?>"
           required>

    <button type="submit">Update User</button>

</form>