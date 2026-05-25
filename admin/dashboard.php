<?php

session_start();

if (
    !isset($_SESSION["role"]) ||
    $_SESSION["role"] !== "admin"
) {
    header("Location: ../pages/login.php");
    exit();
}

include "../includes/db.php";
include "../includes/header.php";


// STATS

$total_rooms = $conn->query("SELECT COUNT(*) AS c FROM rooms")->fetch_assoc()['c'];
$total_reservations = $conn->query("SELECT COUNT(*) AS c FROM projekt")->fetch_assoc()['c'];

$total_users = 0;
if ($conn->query("SHOW TABLES LIKE 'users'")->num_rows > 0) {
    $total_users = $conn->query("SELECT COUNT(*) AS c FROM users")->fetch_assoc()['c'];
}



// CHART DATA (last 7 reservations by date)

$dates = [];
$counts = [];

$dataMap = [];


$sql = "
SELECT DATE(created_at) as rdate, COUNT(*) as total
FROM projekt
WHERE created_at >= CURDATE() - INTERVAL 6 DAY
GROUP BY DATE(created_at)
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $dataMap[$row['rdate']] = $row['total'];
}

// krijimi i 7 diteve te fundit dhe marrja e numrit te rezervimeve per secilen date
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $dates[] = $date;
    $counts[] = isset($dataMap[$date]) ? $dataMap[$date] : 0;
}

// LAST RESERVATIONS

$latest = $conn->query("SELECT * FROM projekt ORDER BY id DESC LIMIT 5");

?>

<link rel="stylesheet" href="admin.css">

<div class="dashboard-container">

    <h1>Admin Dashboard</h1>

    <h3>Welcome, <?php echo htmlspecialchars($_SESSION["fullname"]); ?></h3>

        <!-- ====================== --> <!-- 🔗 QUICK LINKS --> <!-- ====================== --> 
    <div class="dashboard-links">
    <a href="rooms.php">Manage Rooms</a> 
    <a href="reservations.php">Manage Reservations</a>
    <a href="users.php">Manage Users</a> 
    </div> 

    <!-- ================= STATS ================= -->
    <div class="stats-grid">

        <div class="card">
            <h2><?php echo $total_rooms; ?></h2>
            <p>Total Rooms</p>
        </div>

        <div class="card">
            <h2><?php echo $total_reservations; ?></h2>
            <p>Total Reservations</p>
        </div>

        <div class="card">
            <h2><?php echo $total_users; ?></h2>
            <p>Users</p>
        </div>

    </div>


    <!-- ================= CHART ================= -->
    <h2 class="page-title">Reservations Chart (Last 7 Days)</h2>

    <canvas id="myChart" style="width:100%; max-width:900px; margin:auto;"></canvas>


    <!-- ================= LATEST ================= -->
    <h2 class="page-title">Latest Reservations</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name </th>
            <th>Email</th>
            <th>Type of Room</th>
        </tr>

        <?php while($row = $latest->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['NameSurname']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['TypeOfRoom']; ?></td>
        </tr>
        <?php } ?>
    </table>


</div>


<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Reservations',
            data: <?php echo json_encode($counts); ?>,
            borderWidth: 1,
            backgroundColor: '#1e293b'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>




<?php include "../includes/footer.php"; ?>