<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Mpdf\Mpdf;
$host = "localhost";
$username = "root";
$password = "";
$dbname = "forma";
$table = "projekt";
try {

    $dsn = "mysql:host=$host;dbname=$dbname";

    $conn = new PDO($dsn, $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $room_id = isset($_POST['room_id']) ? (int)$_POST['room_id'] : null;

    $stmtRoom = $conn->prepare("SELECT room_type, price FROM rooms WHERE id = :id");
    $stmtRoom->execute([':id' => $room_id]);
    $room = $stmtRoom->fetch(PDO::FETCH_ASSOC);
    $room_name = $room['room_type'];
    $price = $room['price'];
    $sql = "
    INSERT INTO $table
    (user_id, room_id, NameSurname, Email, Arrival, Departure, Adults, Children, Rooms, TypeOfRoom, PaymentMethod, TotalPrice)
    
    VALUES
    (:user_id, :room_id, :namesurname, :email, :arrival, :departure, :adults, :children, :rooms, :roomtype, :payment, :total)
    ";

    $stmt = $conn->prepare($sql);

  $stmt->execute([
    ':user_id' => $_SESSION['user'],  // ose nga auth
    ':room_id' => $room_id,
    ':namesurname' => $namesurname,
    ':email' => $email,
    ':arrival' => $arrival,
    ':departure' => $departure,
    ':adults' => $nrAdults,
    ':children' => $nrChildren,
    ':rooms' => $nrRooms,
    ':roomtype' => $room_name,
    ':payment' => $payment->getMethod(),
    ':total' => $totalprice
]);



    $mpdf = new Mpdf();


    $stylesheet = "
body {
    font-family: DejaVu Sans, Arial;
    background: #f5f7fb;
}

.invoice-box {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #e0e0e0;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    margin: 0;
    font-size: 26px;
    color: #2c3e50;
}

.header p {
    margin: 5px 0;
    color: #7f8c8d;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.info-table td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.info-table td:first-child {
    font-weight: bold;
    color: #34495e;
    width: 40%;
}

.total {
    margin-top: 20px;
    padding: 15px;
    background: #2ecc71;
    color: white;
    text-align: center;
    font-size: 18px;
    border-radius: 8px;
}

.footer {
    text-align: center;
    margin-top: 25px;
    font-size: 12px;
    color: #95a5a6;
}
";

    $data = "

        <div class='invoice-box'>

    <div class='header'>
        <h1>HOTEL INVOICE</h1>
        <p>Booking Confirmation</p>
    </div>

    <table class='info-table'>
        <tr><td>Name</td><td>$namesurname</td></tr>
        <tr><td>Email</td><td>$email</td></tr>
        <tr><td>Arrival</td><td>$arrival</td></tr>
        <tr><td>Departure</td><td>$departure</td></tr>
        <tr><td>Nights</td><td>$numberOfNights</td></tr>
        <tr><td>Adults</td><td>$nrAdults</td></tr>
        <tr><td>Children</td><td>$nrChildren</td></tr>
        <tr><td>Rooms</td><td>$nrRooms</td></tr>
        <tr><td>Room Type</td><td>$room_name</td></tr>
        <tr><td>Payment Method</td><td>".$payment->getMethod()."</td></tr>
    </table>

    <div class='total'>
        TOTAL: $$totalprice
    </div>

    <div class='footer'>
        Thank you for choosing our hotel. We wish you a pleasant stay!
    </div>

    </div>

    ";


    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    $mpdf->WriteHTML($data, \Mpdf\HTMLParserMode::HTML_BODY);


    $mpdf->Output("booking_details.pdf", "D");

}

catch (PDOException $e) {

    $message = "
    <p style='color:red;text-align:center;'>
        ".$e->getMessage()."
    </p>
    ";
}
?>