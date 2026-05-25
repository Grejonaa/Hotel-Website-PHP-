<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "forma";
$table = "projekt";

try {

    $dsn = "mysql:host=$host;dbname=$dbname";

    $conn = new PDO($dsn, $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "
    INSERT INTO $table
    (NameSurname, Email, Arrival, Departure, Adults, Children, Rooms, TypeOfRoom, PaymentMethod, TotalPrice)
    
    VALUES
    (:namesurname, :email, :arrival, :departure, :adults, :children, :rooms, :roomtype, :payment, :total)
    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([

        ':namesurname' => $namesurname,
        ':email' => $email,
        ':arrival' => $arrival,
        ':departure' => $departure,
        ':adults' => $nrAdults,
        ':children' => $nrChildren,
        ':rooms' => $nrRooms,
        ':roomtype' => $room_type,
        ':payment' => $payment->getMethod(),
        ':total' => $totalprice
    ]);


    require_once __DIR__ . '/../vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();


    $stylesheet = "

        body {
            font-family: Arial;
        }

        h1 {
            text-align: center;
        }

        .booking-container {
            border: 1px solid #000;
            padding: 15px;
            border-radius: 10px;
        }

    ";


    $data = "

        <h1>Booking Details</h1>

        <div class='booking-container'>

            <p><strong>Name:</strong> $namesurname</p>

            <p><strong>Email:</strong> $email</p>

            <p><strong>Arrival:</strong> $arrival</p>

            <p><strong>Departure:</strong> $departure</p>

            <p><strong>Adults:</strong> $nrAdults</p>

            <p><strong>Children:</strong> $nrChildren</p>

            <p><strong>Rooms:</strong> $nrRooms</p>

            <p><strong>Room Type:</strong> $room_type</p>

            <p><strong>Payment:</strong> ".$payment->getMethod()."</p>

            <p><strong>Nights:</strong> $numberOfNights</p>

            <p><strong>Total Price:</strong> $$totalprice</p>

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