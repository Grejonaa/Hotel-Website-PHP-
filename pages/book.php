<?php
session_start();

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



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $namesurname = htmlspecialchars(trim($_POST['name_surname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $arrival = $_POST['arrival_date'];
        $departure = $_POST['departure_date'];

        $nrAdults = (int)$_POST['adults'];
        $nrChildren = (int)$_POST['children'];
        $nrRooms = (int)$_POST['nrrooms'];

        $room_type = $_POST['room_type'];
        $payment_method = $_POST['payment_method'];

        
        setcookie("username", $namesurname, time() + 3600 * 24 * 30);

    
        if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $message = "<p style='color:red;text-align:center;'>Email invalid!</p>";
        }
        elseif (!preg_match("/^[a-zA-Z\s]+$/", $namesurname)) {
            $message = "<p style='color:red;text-align:center;'>Emri duhet te permbaje vetem shkronja!</p>";
        }
        elseif ($nrRooms > 5 || $nrRooms < 1) {
            $message = "<p style='color:red;text-align:center;'>Maksimumi 5 dhoma!</p>";
        }
        elseif ($nrAdults < 1) {
            $message = "<p style='color:red;text-align:center;'>Duhet te kete te pakten 1 adult!</p>";
        }
        else {

            $arrivalDate = DateTime::createFromFormat('Y-m-d', $arrival);
            $departureDate = DateTime::createFromFormat('Y-m-d', $departure);
            $todayDate = new DateTime($today);

            if (!$arrivalDate || !$departureDate) {
                $message = "<p style='color:red;text-align:center;'>Datat nuk janë valide!</p>";
            }
            elseif ($arrivalDate < $todayDate) {
                $message = "<p style='color:red;text-align:center;'>Data e ardhjes duhet te jete nga sot!</p>";
            }
            elseif ($departureDate <= $arrivalDate) {
                $message = "<p style='color:red;text-align:center;'>Data e largimit duhet te jete pas ardhjes!</p>";
            }else {

                $numberOfNights = $arrivalDate->diff($departureDate)->days;


                $totalGuests = $nrAdults + $nrChildren;

                $capacities = [
                    "Classic" => 2,
                    "superior" => 3,
                    "family" => 4,
                    "executive" => 2,
                        "twin" => 2,
                        "Grand_Deluxe" => 4,
                        "Presidential_Suite" => 6
                            ];

                          $capacity = $capacities[$room_type] ?? 0;

                $maxCapacity = $capacity * $nrRooms;

                if ($totalGuests > $maxCapacity) {
                    $message = "<p style='color:red;text-align:center;'>
                    $room_type  me $nrRooms dhoma lejon maksimum $maxCapacity persona!
                    </p>";
                }
                else {
                    switch($room_type) {
                        case "Classic": $pricePerNight = 120; break;
                        case "superior": $pricePerNight = 250; break;
                        case "family": $pricePerNight = 180; break;
                        case "executive": $pricePerNight = 220; break;
                        case "twin": $pricePerNight = 150; break;
                        case "Grand_Deluxe": $pricePerNight = 240; break;
                        case "Presidential_Suite": $pricePerNight = 500; break;
                        default: $pricePerNight = 100;
                    }

                    $totalprice = $nrRooms * $numberOfNights * $pricePerNight;

                    $payment = new Payment($payment_method);
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

                $message = "
                <div class='overview'>
                    <h3>Rezervimi u krye me sukses!</h3>
                    <p><strong>Emri:</strong> $namesurname</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Netë:</strong> $numberOfNights</p>
                    <p><strong>Dhomat:</strong> $nrRooms</p>
                    <p><strong>Tipi:</strong> $room_type</p>
                    <p><strong>Pagesa:</strong> ".$payment->getMethod()."</p>
                    <p><strong>Totali:</strong> $$totalprice</p>
                </div>
                ";

                }
            }
        }
    }

?>









<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hotel Booking</title>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background: url("images/bg3.jpeg") no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 20px;
}
.form-container {
    background-color: rgba(255,255,255,0.95);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 500px;
    margin: 30px auto;
}
.form-container h2 {
    text-align: center;
    color: #333;
}
.form-group {
    margin-bottom: 10px;
}
.form-group input,
.form-group select {
    width: 95%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.form-group input[type="submit"] {
    background-color: #7fc142;
    color: #fff;
    font-weight: bold;
    border: none;
    cursor: pointer;
    padding: 10px;
    width: 100%;
}
.form-group input[type="submit"]:hover {
    background-color: #b58b2a;
}
.overview {
    background:#e9ffe9;
    padding:15px;
    border-radius:10px;
    margin-top:20px;
}
.container {
    display: flex;
    justify-content: center;
    gap: 40px;
    align-items: flex-start;
    margin-top: 40px;
}
.left-column {
    flex: 1.2;
}
.right-column {
    flex: 2;
}
.rooms-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}
.room-card {
    background:#fff;
    padding:15px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.2);
    text-align:center;
    width:32%;
}
.room-card img {
    width:100%;
    border-radius:10px;
}
.big-room {
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.3);
    text-align:center;
}
.big-room img {
    width:100%;
    border-radius:15px;
}


</style>
</head>
<body>
    <div class="form-container">
    <h2>Book Your Rooms</h2>

    <p style="text-align:center;">
        Welcome
    </p>

    <form method="POST">
        <div class="form-group">
            <input type="text" name="name_surname" placeholder="Name and Surname" required>
        </div>

        <div class="form-group">
            <input type="text" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="date" name="arrival_date" min="<?= $today ?>" required>
        </div>

        <div class="form-group">
            <input type="date" name="departure_date" min="<?= $today ?>" required>
        </div>

        <div class="form-group">
            <input type="number" name="adults" placeholder="Adults" min="1" required>
        </div>

        <div class="form-group">
            <input type="number" name="children" placeholder="Children" min="0">
        </div>

        <div class="form-group">
            <input type="number" name="nrrooms" placeholder="Rooms" min="1" max="5" required>
        </div>

        <div class="form-group">
            <select name="room_type">
                <option value="Classic">Classic Room - $120</option>
                <option value="superior">Superior Room- $250</option>
                <option value="family">Family Room- $180</option>
                <option value="executive">Executive Room- $220</option>
                <option value="twin">Twin Room- $150</option>
                <option value="Grand_Deluxe">Grand Deluxe - $240</option>
                <option value="Presidential_Suite">Presidential Suite - $500</option>
            </select>
        </div>

        
        <div class="form-group">
            <select name="payment_method" required>
                <option value="Pay at Hotel">Pay at Hotel</option>
                <option value="Credit / Debit Card">Credit / Debit Card</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="Book">
        </div>
    </form>

    
</div>


<div class="container">

    <div class="left-column">
        <div class="big-room">
            <img src="images/room5.jpeg" alt="Presidential Suite">
            <h2>Presidential Suite</h2>
            <p>Luxury experience for 6 Guests</p>
            <p>$500/night</p>
        </div>
    </div>

    <div class="right-column">
        <div class="rooms-row">
            <div class="room-card">
                <img src="images/room1.avif" alt="Classic Room">
                <h3>Classic Room</h3>
                <p>2 Guests - $120/night</p>
            </div>
            <div class="room-card">
                <img src="images/room2.jpeg" alt="Family Room">
                <h3>Family Room</h3>
                <p>4 Guests - $180/night</p>
            </div>
            <div class="room-card">
                <img src="images/room3.jpeg" alt="Grand Deluxe">
                <h3>Grand Deluxe</h3>
                <p>4 Guests - $240/night</p>
            </div>
        </div>

        <div class="rooms-row">
            <div class="room-card">
                <img src="images/room4.jpeg" alt="Twin Room">
                <h3>Twin Room</h3>
                <p>2 Guests - $150/night</p>
            </div>
            <div class="room-card">
                <img src="images/room6.jpeg" alt="Superior Room">
                <h3>Superior Room</h3>
                <p>3 Guests - $200/night</p>
            </div>
            <div class="room-card">
                <img src="images/room7.avif" alt="Executive Room">
                <h3>Executive Room</h3>
                <p>2 Guests - $220/night</p>
            </div>
        </div>
    </div>

</div>

</body>
</html>