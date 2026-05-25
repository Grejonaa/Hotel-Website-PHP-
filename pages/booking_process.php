<?php
require_once "../auth/auth_check.php";
require_once "../classes/Room.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = "";
$today = date("Y-m-d");

if (!isset($_COOKIE['username'])) {
    setcookie("username", "Guest", time() + 3600 * 24 * 30);
}

class Payment {
    private $method;

    public function __construct($method) {
        $this->method = $method;
    }

    public function getMethod() {
        return $this->method;
    }
}

$capacities = [
    "Classic" => 2,
    "superior" => 3,
    "family" => 4,
    "executive" => 2,
    "twin" => 2,
    "Grand_Deluxe" => 4,
    "Presidential_Suite" => 6
];

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // FORM DATA
        $namesurname = htmlspecialchars(trim($_POST['name_surname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $arrival = $_POST['arrival_date'];
        $departure = $_POST['departure_date'];

        $nrAdults = (int)$_POST['adults'];
        $nrChildren = (int)$_POST['children'];
        $nrRooms = (int)$_POST['nrrooms'];

        $room_id = (int)$_POST['room_id'];
        $payment_method = $_POST['payment_method'];

        // DATE OBJECTS
        $arrivalDate = DateTime::createFromFormat('Y-m-d', $arrival);
        $departureDate = DateTime::createFromFormat('Y-m-d', $departure);
        $todayDate = new DateTime($today);

        $errors = [];

        // VALIDATION
        if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $errors[] = "Email invalid!";
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", $namesurname)) {
            $errors[] = "Emri duhet te permbaje vetem shkronja!";
        }

        if ($nrRooms < 1 || $nrRooms > 5) {
            $errors[] = "Maksimumi 5 dhoma!";
        }

        if ($nrAdults < 1) {
            $errors[] = "Duhet te kete te pakten 1 adult!";
        }

        if (!$arrivalDate || !$departureDate) {
            $errors[] = "Datat nuk jane valide!";
        } elseif ($arrivalDate < $todayDate) {
            $errors[] = "Data e ardhjes duhet te jete nga sot!";
        } elseif ($departureDate <= $arrivalDate) {
            $errors[] = "Data e largimit duhet te jete pas ardhjes!";
        }

        // GET ROOM FROM DB (IMPORTANT FIX)
        $conn = new PDO("mysql:host=localhost;dbname=forma", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmtRoom = $conn->prepare("SELECT room_type, price FROM rooms WHERE id = :id");
        $stmtRoom->execute([':id' => $room_id]);
        $room = $stmtRoom->fetch(PDO::FETCH_ASSOC);

        if (!$room) {
            $errors[] = "Dhoma nuk ekziston!";
        }

        $room_type = $room['room_type'] ?? null;
        $pricePerNight = $room['price'] ?? 100;

        // CAPACITY CHECK
        $capacity = $capacities[$room_type] ?? 0;
        $maxCapacity = $capacity * $nrRooms;

        $totalGuests = $nrAdults + $nrChildren;

        if ($totalGuests > $maxCapacity) {
            $errors[] = "$room_type me $nrRooms dhoma lejon maksimum $maxCapacity persona!";
        }

        // ERROR OUTPUT
        if (!empty($errors)) {

            $message = "<div style='color:red;text-align:center;'>";

            foreach ($errors as $error) {
                $message .= "<p>$error</p>";
            }

            $message .= "</div>";

        } else {

            // CALCULATIONS
            $numberOfNights = $arrivalDate->diff($departureDate)->days;

            $totalprice = $nrRooms * $numberOfNights * $pricePerNight;

            $payment = new Payment($payment_method);

            // SESSION
            $_SESSION['last_booking'] = [
                "name" => $namesurname,
                "email" => $email,
                "arrival" => $arrival,
                "departure" => $departure,
                "rooms" => $nrRooms,
                "type" => $room_type,
                "payment" => $payment->getMethod(),
                "total" => $totalprice
            ];

            // SUCCESS MESSAGE
            $message = "
            <div class='overview'>
                <h3>Rezervimi u krye me sukses!</h3>

                <p><strong>Emri:</strong> $namesurname</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Nete:</strong> $numberOfNights</p>
                <p><strong>Dhomat:</strong> $nrRooms</p>
                <p><strong>Tipi:</strong> $room_type</p>
                <p><strong>Pagesa:</strong> ".$payment->getMethod()."</p>
                <p><strong>Totali:</strong> $$totalprice</p>
            </div>
            ";

            // CALL DB + PDF
            require_once "booking_database.php";
        }
    }

} catch (PDOException $e) {
    $message = "<p style='color:red;text-align:center;'>".$e->getMessage()."</p>";
}
?>