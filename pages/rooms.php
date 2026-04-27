<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<!-- HOME -->
<section class="home">
    <div class="content">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="../images/banner2.jpeg" alt="">
                <div class="text">
                    <h1>Spend Your Holiday</h1>
                    <p>A Royal Hotel delivers unparalleled luxury...</p>
                    <div class="flex">
                        <a href='about.php' class="primary-btn">READ MORE</a>
                        <a href='contact.php' class="secondary-btn">CONTACT US</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

<!-- ROOMS -->
<section class="rooms">
    <div class="container top">
        <div class="heading">
            <h1>EXPLORE</h1>
            <h2>Superior Rooms</h2>
            <p>The rooms at a Royal Hotel are exquisitely designed...</p>
        </div>

        <div class="content mtop">
            <div class="owl-carousel owl-carousel1 owl-theme">

                <?php
                $rooms = [
                    ["img"=>"room1.avif","price"=>250],
                    ["img"=>"room2.jpeg","price"=>250],
                    ["img"=>"room3.jpeg","price"=>250],
                    ["img"=>"room4.jpeg","price"=>250],
                    ["img"=>"room5.jpeg","price"=>250],
                ];

                foreach($rooms as $room){
                ?>
                <div class="items">
                    <div class="images">
                        <img src="../images/<?php echo $room['img']; ?>">
                    </div>
                    <div class="text">
                        <h2>Superior Rooms</h2>
                        <p>Luxury room with premium amenities.</p>
                        <div class="button flex">
                            <button>
                                <a href="book.php" class="primary-btn">BOOK NOW</a>
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

<!-- NEWSLETTER -->
<section class="newsletter mtop">
    <div class="container flex_space">
        <h1>Subscribe to Our Newsletter</h1>
        <input type="text" placeholder="Your Email">
        <input type="button" value="Subscribe">
    </div>
</section>

<?php include "../includes/footer.php"; ?>
