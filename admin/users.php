<link rel="stylesheet" href="admin.css">

<?php
include "../includes/db.php";
include "../auth/auth_check.php";

$sql = "SELECT * FROM users ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="page-title">Manage Users</h1>

<a class="action-btn" href="add_user.php">Add User</a>

<table>

    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>

        <td><?= $row['id']; ?></td>

        <td><?= htmlspecialchars($row['fullname']); ?></td>

        <td><?= htmlspecialchars($row['email']); ?></td>

        <td><?= htmlspecialchars($row['role']); ?></td>

        <td><?= $row['created_at']; ?></td>

        <td>

            <a class="action-btn edit-btn"
               href="edit_user.php?id=<?= $row['id']; ?>">
               Edit
            </a>

            <a class="action-btn delete-btn"
               href="delete_user.php?id=<?= $row['id']; ?>"
               onclick="return confirm('Are you sure?')">
               Delete
            </a>

        </td>

    </tr>

    <?php } ?>

</table>