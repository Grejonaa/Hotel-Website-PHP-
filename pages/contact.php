<?php

include "../includes/header.php";
include "../includes/navbar.php";
include "contact_process.php";

$city = "Prishtina";
$apiKey = "e67981ab806c4190bc6175653262505";

// URL e WeatherAPI
$url = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city&aqi=no";

// Marrja e te dhenave
$response = @file_get_contents($url);

// Kontrollon a funksionoi API
if($response !== false){

    $data = json_decode($response, true);

    $temp = $data['current']['temp_c'];
    $condition = $data['current']['condition']['text'];
    $icon = $data['current']['condition']['icon'];
    $humidity = $data['current']['humidity'];

}else{

    $temp = "";
    $condition = "";
    $icon = "";
    $humidity = "";
}

?>

 <div class="weather-container">

    <h2>Current Weather in <?php echo $city; ?></h2>

    <?php if($temp != ""){ ?>

        <img src="https:<?php echo $icon; ?>">

        <p>
            Temperature:
            <?php echo $temp; ?> °C
        </p>

        <p>
            Weather:
            <?php echo $condition; ?>
        </p>

        <p>
            Humidity:
            <?php echo $humidity; ?>%
        </p>

    <?php } else { ?>

        <p>Weather data unavailable.</p>

    <?php } ?>

</div>
<div class="contact-container">
    <h2> Contact Us </h2>


    <?php if (!empty($errors)): ?>
    <div style="color: red; margin-bottom: 20px;">
        <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_POST['send']) && $successMsg !=""): ?>
    <div style="color: green; margin-bottom: 20px;">
        <p><?php echo $successMsg; ?></p>
        </div>
    <?php endif; ?>

<form action="send.php" method="POST">
        <div class="contact-group">
            <label for="name"> Full Name: </label>
            <input type="text" id="name" name="name" required>
        </div>
<div class="contact-group">
    <label for="email"> Email Address: </label>
    <input type="email" id="email" name="email" required>
</div>
<div class="contact-group">
    <label for="phone"> Phone Number: </label>
    <input type="tel" id="phone" name="phone" required>
</div>
<div class="contact-group">
    <label for="subject"> Subject: </label>
    <input type="text" id="subject" name="subject" required>
</div>
<div class="contact-group">
    <label for="message"> Your Message: </label>
    <textarea id="message" name="message" required>
</textarea>
</div>
<div class="contact-group">
    <button type="submit" name="send"> Send Message </button>
</div>
</form>
</div>

<?php include "../includes/footer.php"; ?>