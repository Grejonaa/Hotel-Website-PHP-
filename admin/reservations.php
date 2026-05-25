<?php
include "../includes/db.php";
include "../includes/header.php";
include "../auth/auth_check.php";

$sql = "SELECT * FROM projekt ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="container" style="margin-top:50px;">

    <h2>Manage Reservations</h2>

    <table border="1" width="100%" cellpadding="10">
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
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['NameSurname']); ?></td>
            <td><?php echo htmlspecialchars($row['Email']); ?></td>
            <td><?php echo $row['Arrival']; ?></td>
            <td><?php echo $row['Departure']; ?></td>
            <td><?php echo $row['Adults']; ?></td>
            <td><?php echo $row['Children']; ?></td>
            <td><?php echo $row['Rooms']; ?></td>
            <td><?php echo $row['TypeOfRoom']; ?></td>

            <td>
                <a href="view-reservation.php?id=<?php echo $row['id']; ?>">View</a> |
                <a href="edit-reservation.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete-reservation.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('A je i sigurt?')">
                   Delete
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>
</div>

<?php include "../includes/footer.php"; ?>
