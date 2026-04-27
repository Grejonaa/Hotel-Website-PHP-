<?php include "../includes/header.php";?>
<?php include "../includes/navbar.php"; ?>
<!--HOME-->
    <section class="home">
        <div class="content">
            <div class="owl-carousel owl-theme">

            <?php
            $images = ["banner2.jpeg","banner1.webp","banner3.avif","banner4.avif","banner55.avif"];
            foreach($images as $img):
            ?>
                <div class="item">
                    <img src="../images/banner2.jpeg" alt="">
                    <div class="text">
                        <h1>Spend Your Holiday</h1>
                        <p>
                            A Royal Hotel delivers unparalleled luxury, combining elegant accommodations with exceptional service in a grand, sophisticated setting.
                        </p>
                        <div class="flex">
                            <a href='about.php' target='_blank' class="primary-btn">READ MORE</a>
                            <a href='contact.php' target='_blank' class="secondary-btn">CONTACT US</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.owl-carousel').owlCarousel({
         loop:true,
         margin: 0,
         nav:true,
         dots: false,
         navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
         responsive:{
           0:{
            items:1
            },
           768:{
            items:1
            },
           1000:{
            items:1
            }
          }
        })
    </script>
 <!--HOME-->
<div class="about">
 <div class="header">
    <h1>Welcome to Royal Hotel</h1>
</div>

<div class="container">
    <div class="about-section">
        <div class="about-text">
            <h1>ABOUT US</h1>
            <h2>About Our Hotel</h2>
            <p>Royal Hotel is a premier destination for travelers seeking an unforgettable experience. Nestled in the heart of the city, our hotel offers luxurious accommodations, world-class amenities, and unparalleled service.</p>
            <p>Our rooms are designed with your comfort in mind, featuring plush bedding, modern decor, and all the conveniences you need for a relaxing stay. Enjoy a gourmet meal at our on-site restaurant, unwind at our spa, or take a dip in our rooftop pool with stunning views of the city skyline.</p>
            <p>At Royal Hotel, we are committed to making your stay as comfortable and enjoyable as possible. Whether you're here for business or leisure, our dedicated staff is here to cater to your every need.</p>
        </div>
        <div class="about-image">
            <img src="../images/bg3.jpeg" alt="Luxurious Hotel Room">
        </div>
    </div>
</div>
</div>

<section class="rooms">
    <h2 class="section-title">Our Rooms</h2>
    <div class="room-container">

        <div class="room-box">
            <img src="../images/banner1.webp">
            <h3>Deluxe Room</h3>
            <p>$120 / night</p>
        </div>

        <div class="room-box">
            <img src="../images/banner2.jpeg">
            <h3>Family Room</h3>
            <p>$180 / night</p>
        </div>

        <div class="room-box">
            <img src="../images/banner3.avif">
            <h3>Suite Room</h3>
            <p>$250 / night</p>
        </div>

    </div>
</section>

<section class="services">
    <h2 class="section-title">Our Services</h2>
    <div class="service-box">

        <div>
            <i class="fa fa-wifi"></i>
            <p>Free WiFi</p>
        </div>

        <div>
            <i class="fa fa-swimmer"></i>
            <p>Swimming Pool</p>
        </div>

        <div>
            <i class="fa fa-spa"></i>
            <p>Spa & Wellness</p>
        </div>

        <div>
            <i class="fa fa-utensils"></i>
            <p>Restaurant</p>
        </div>

    </div>
</section>

<div class="container">
    <div class="video-container">
        <video src="../images/video.mp4.mp4" autoplay loop muted></video>
    </div>
</div>


<section class="gallery">
    <h2 class="section-title">Gallery</h2>
    <div class="gallery-box">
        <img src="../images/banner1.webp">
        <img src="../images/banner2.jpeg">
        <img src="../images/banner3.avif">
        <img src="../images/banner4.avif">
    </div>
</section>

<section class="cta">
    <h2>Book Your Stay Now</h2>
    <a href="contact.php" class="primary-btn">Contact Us</a>
</section>

<?php include "../includes/footer.php"; ?>





