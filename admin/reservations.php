<link rel="stylesheet" href="admin.css">

<?php
include "../includes/db.php";
include "../auth/auth_check.php";

$sql = "SELECT * FROM projekt ORDER BY id DESC";
$result = $conn->query($sql);
?>

<h1 class="page-title">Manage Reservations</h1>

<table>

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Arrival</th>
        <th>Departure</th>
        <th>Adults</th>
        <th>Children</th>
        <th>Rooms</th>
        <th>Room Type</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>

        <td><?= $row['id']; ?></td>

        <td><?= htmlspecialchars($row['NameSurname']); ?></td>

        <td><?= htmlspecialchars($row['Email']); ?></td>

        <td><?= $row['Arrival']; ?></td>

        <td><?= $row['Departure']; ?></td>

        <td><?= $row['Adults']; ?></td>

        <td><?= $row['Children']; ?></td>

        <td><?= $row['Rooms']; ?></td>

        <td><?= $row['TypeOfRoom']; ?></td>

        <td>

            <a class="action-btn"
               href="view-reservation.php?id=<?= $row['id']; ?>">
               View
            </a>

            <a class="action-btn edit-btn"
               href="edit-reservation.php?id=<?= $row['id']; ?>">
               Edit
            </a>

            <a class="action-btn delete-btn"
               href="delete-reservation.php?id=<?= $row['id']; ?>"
               onclick="return confirm('A jeni i sigurt?')">
               Delete
            </a>

        </td>

    </tr>

    <?php } ?>

</table>
