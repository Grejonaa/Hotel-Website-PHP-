<?php

session_start();

require_once "../includes/db.php";


if(
    !isset($_SESSION["role"]) ||
    $_SESSION["role"] !== "admin"
){
    header("Location: ../pages/login.php");
    exit();
}


$stmt = $conn->prepare(
    "SELECT * FROM rooms"
);

$stmt->execute();

$result = $stmt->get_result();

include "../includes/header.php";
?>

<link rel="stylesheet" href="admin.css">

<h1 class="page-title">
    Manage Rooms
</h1>

<a
    href="add_room.php"
    class="add-room-btn"
>
    Add New Room
</a>

<table>

    <tr>

        <th>ID</th>
        <th>Image</th>
        <th>Room Name</th>
        <th>Room Type</th>
        <th>Price</th>
        <th>Description</th>
        <th>Actions</th>

    </tr>

    <?php while($room = $result->fetch_assoc()): ?>

        <tr>

            <td>
                <?php echo $room["id"]; ?>
            </td>

            <td>

                <img
                    src="../uploads/<?php echo $room['image']; ?>"
                    width="120"
                >

            </td>

            <td>

                <?php
                    echo htmlspecialchars(
                        $room["room_name"]
                    );
                ?>

            </td>

            <td>

                <?php
                    echo htmlspecialchars(
                        $room["room_type"]
                    );
                ?>

            </td>

            <td>

                $
                <?php
                    echo htmlspecialchars(
                        $room["price"]
                    );
                ?>

            </td>

            <td>

                <?php
                    echo htmlspecialchars(
                        $room["description"]
                    );
                ?>

            </td>

            <td>

                <a
                    class="action-btn edit-btn"
                    href="edit_room.php?id=<?php echo $room['id']; ?>"
                >
                    Edit
                </a>

                <a
                    class="action-btn delete-btn"
                    href="delete_room.php?id=<?php echo $room['id']; ?>"
                    onclick="return confirm('Are you sure?')"
                >
                    Delete
                </a>

            </td>

        </tr>

    <?php endwhile; ?>

</table>