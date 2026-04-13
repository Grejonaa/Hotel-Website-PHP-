<?php
include "../includes/header.php"; 
include "../includes/navbar.php"; 

$title = "Welcome to Royal Hotel";

$aboutTexts = [
 "Royal Hotel is a premier destination offering luxury and comfort.",
    "Our rooms are designed with your comfort in mind, combining elegance and modern amenities.",
    "At Royal Hotel, we are committed to providing exceptional service to all our guests."
];
?>

<section class="home">
    <div class="content">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="../images/banner2.jpeg" alt="Hotel Banner">

                <div class="text">
                    <h1>Spend Your Holiday</h1>
                    <p>A Royal Hotel delivers unparalleled luxury...</p>

                    <div class="flex">
                        <a href='about.php' class="primary-btn">Read More</a>
                        <a href='contact.php' class="secondary-btn">CONTACT US</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="about">
    <div class="header">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="container">
        <div class="about-section">

            <div class="about-text">
                <h1>ABOUT US</h1>
                <h2>About Our Hotel</h2>

                <?php
                foreach($aboutTexts as $text){
                    echo "<p>$text</p>";
                }
                ?>
            </div>

                
            <div class="about-image">
                <img src="../images/bg3.jpeg" alt="Hotel Image">
            </div>
            
        </div>
    </div>
</div>

<div class="container">
    <div class="video-container">
        <video src="../images/video.mp4.mp4" autoplay loop muted></video>
    </div>
</div>

<?php include "../includes/footer.php"; ?>