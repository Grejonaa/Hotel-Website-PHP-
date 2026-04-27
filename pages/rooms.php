<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

 <!--HOME-->
    <section class="home">
        <div class="content">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="/Hotel/images/banner2.jpeg" alt="">
                    <div class="text">
                        <h1>Spend Your Holiday</h1>
                        <p>
                            A Royal Hotel delivers unparalleled luxury, combining elegant accommodations with exceptional service in a grand, sophisticated setting.
                        </p>
                        <div class="flex">
                        <a href='about.html' target='_blank' class="primary-btn">READ MORE</a>
                        <a href='contact.html' target='_blank' class="secondary-btn">CONTACT US</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/Hotel/images/banner1.webp" alt="">
                    <div class="text">
                        <h1>Spend Your Holiday</h1>
                        <p>
                            A Royal Hotel delivers unparalleled luxury, combining elegant accommodations with exceptional service in a grand, sophisticated setting.
                        </p>
                        <div class="flex">
                        <a href='about.html' target='_blank' class="primary-btn">READ MORE</a>
                        <a href='contact.html' target='_blank' class="secondary-btn">CONTACT US</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/Hotel/images/banner3.avif" alt="">
                    <div class="text">
                        <h1>Spend Your Holiday</h1>
                        <p>
                            A Royal Hotel delivers unparalleled luxury, combining elegant accommodations with exceptional service in a grand, sophisticated setting.
                        </p>
                        <div class="flex">
                        <a href='about.html' target='_blank' class="primary-btn">READ MORE</a>
                        <a href='contact.html' target='_blank' class="secondary-btn">CONTACT US</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/Hotel/images/banner4.avif" alt="">
                    <div class="text">
                        <h1>Spend Your Holiday</h1>
                        <p>
                            A Royal Hotel delivers unparalleled luxury, combining elegant accommodations with exceptional service in a grand, sophisticated setting.
                        </p>
                        <div class="flex">
                        <a href='about.html' target='_blank' class="primary-btn">READ MORE</a>
                        <a href='contact.html' target='_blank' class="secondary-btn">CONTACT US</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/Hotel/images/banner55.avif" alt="">
                    <div class="text">
                        <h1>Spend Your Holiday</h1>
                        <p>
                            A Royal Hotel delivers unparalleled luxury, combining elegant accommodations with exceptional service in a grand, sophisticated setting.
                        </p>
                        <div class="flex">
                        <a href='about.html' target='_blank' class="primary-btn">READ MORE</a>
                        <a href='contact.html' target='_blank' class="secondary-btn">CONTACT US</a>
                        </div>
                    </div>
                </div>
               
            </div>

        </div>
    </section>
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

<!-- BOOK -->
<section class="book">
    <div class="container flex_space">
        <div class="text">
            <h1><span>Book</span> Your Rooms</h1>
        </div>
        <div class="form">
            <form class="grid">
                <input type="date" placeholder="Arrival Date">
                <input type="date" placeholder="Departure Date">
                <input type="number" placeholder="Adults">
                <input type="number" placeholder="Children">
                <button class="primary-btn">BOOK NOW</button>
            </form>
        </div>
    </div>
</section>
<!-- ROOMS SECTION START -->

<section class="rooms">

    <div class="container top">

        <!-- ================= SUPERIOR ROOMS ================= -->
        <div class="heading">
            <h1>EXPLORE</h1>
            <h2>Superior Rooms</h2>
            <p>The rooms at a Royal Hotel are exquisitely designed, offering plush furnishings, modern amenities, and an ambiance of refined elegance for a truly luxurious stay.</p>
        </div>

        <?php
        $superiorRooms = [
            ["img"=>"room1.avif","price"=>250,"stars"=>5],
            ["img"=>"room2.jpeg","price"=>250,"stars"=>5],
            ["img"=>"room3.jpeg","price"=>250,"stars"=>5],
            ["img"=>"room4.jpeg","price"=>250,"stars"=>5],
            ["img"=>"room5.jpeg","price"=>250,"stars"=>5],
            ["img"=>"room6.jpeg","price"=>250,"stars"=>5],
            ["img"=>"room7.avif","price"=>250,"stars"=>5],
        ];
        ?>

        <div class="content mtop">
            <div class="owl-carousel owl-carousel1 owl-theme">

                <?php foreach($superiorRooms as $room){ ?>

                <div class="items">
                    <div class="images">
                        <img src="../images/<?php echo $room['img']; ?>" alt="">
                    </div>

                    <div class="text">
                        <h2>Superior Room</h2>

                        <div class="rate flex">
                            <?php for($i=0; $i<$room['stars']; $i++){ ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </div>

                        <p>Superior Room offers enhanced comfort with premium amenities.</p>

                        <div class="button flex">
                            <button>
                                <a href="book.php" class="primary-btn" target="_blank">BOOK NOW</a>
                            </button>

                            <h3>$<?php echo $room['price']; ?> <span><br>Per Night</span></h3>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>

    </div>


    <!-- ================= ECONOMIC ROOMS ================= -->
    <div class="container top">

        <div class="heading">
            <h1>EXPLORE</h1>
            <h2>Economic Rooms</h2>
            <p>Budget-friendly rooms with comfort and essential amenities for all travelers.</p>
        </div>

        <?php
        $economicRooms = [
            ["img"=>"eroom1.jpeg","price"=>50,"stars"=>4],
            ["img"=>"eroom2.jpeg","price"=>50,"stars"=>3],
            ["img"=>"eroom3.jpeg","price"=>50,"stars"=>3],
            ["img"=>"eroom4.jpeg","price"=>50,"stars"=>5],
            ["img"=>"eroom5.jpeg","price"=>50,"stars"=>5],
            ["img"=>"eroom6.jpeg","price"=>50,"stars"=>4],
            ["img"=>"eroom7.jpeg","price"=>50,"stars"=>4],
        ];
        ?>

        <div class="content mtop">
            <div class="owl-carousel owl-carousel2 owl-theme">

                <?php foreach($economicRooms as $room){ ?>

                <div class="items">
                    <div class="images">
                        <img src="../images/<?php echo $room['img']; ?>" alt="">
                    </div>

                    <div class="text">
                        <h2>Economic Room</h2>

                        <div class="rate flex">
                            <?php for($i=0; $i<$room['stars']; $i++){ ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </div>

                        <p>Comfortable budget rooms with essential amenities and great value.</p>

                        <div class="button flex">
                            <button>
                                <a href="book.php" class="primary-btn" target="_blank">BOOK NOW</a>
                            </button>

                            <h3>$<?php echo $room['price']; ?> <span><br>Per Night</span></h3>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>

    </div>

</section>

<!-- ================= OWL CAROUSEL JS ================= -->
<script src="jquery.min.js"></script>
<script src="owl.carousel.min.js"></script>

<script>
$(document).ready(function(){

    // Superior Rooms
    $('.owl-carousel1').owlCarousel({
        loop:true,
        margin:40,
        nav:true,
        dots:false,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        responsive:{
            0:{ items:1 },
            768:{ items:2, margin:10 },
            1000:{ items:3 }
        }
    });

    // Economic Rooms
    $('.owl-carousel2').owlCarousel({
        loop:true,
        margin:40,
        nav:true,
        dots:false,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        responsive:{
            0:{ items:1 },
            768:{ items:2, margin:10 },
            1000:{ items:3 }
        }
    });

});
</script>

<!-- ROOMS SECTION END -->


<!-- NEWSLETTER -->
<section class="newsletter mtop">
    <div class="container flex_space">
        <h1>Subscribe to Our Newsletter</h1>
        <input type="text" placeholder="Your Email">
        <input type="button" value="Subscribe">
    </div>
</section>

<?php include "../includes/footer.php"; ?>