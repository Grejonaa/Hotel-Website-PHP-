<header>
    <div class="content flex_space">
        <div class="logo">
            <img src="/Hotel/images/logo.jpeg" alt="">
        </div>
        <div class="navlinks">
            <ul id="menulist">
                <li><a href="/Hotel/index.php">Home</a></li>
                <li><a href="/Hotel/pages/rooms.php">Rooms</a></li>
                <li><a href="/Hotel/pages/about.php">About</a></li>
                <li><a href="/Hotel/pages/contact.php">Contact</a></li>

                <li>
                    <button>
                        <a href="/Hotel/pages/book.php" class="primary-btn">BOOK NOW</a>
                    </button>
                </li>

                <!-- USER INFO -->
                <?php if (isset($_SESSION["user"])): ?>
                    <li>
                        <span>👤 <?php echo $_SESSION["user"]; ?></span>
                    </li>

                  
                    <?php if ($_SESSION["role"] === "admin"): ?>
                        <li><a href="#">Admin Panel</a></li>
                    <?php endif; ?>

                    <li><a href="/Hotel/auth/logout.php">Logout</a></li>

                <?php else: ?>
                    <li><a href="/Hotel/auth/login.php">Login</a></li>
                <?php endif; ?>

            </ul>
            <span class="fa fa-bars" onclick="menutoggle()"></span>
        </div>
    </div>
</header>
 <script>
        var menulist= document.getElementById('menulist');
        menulist.style.maxHeight= '0px';

        function menutoggle(){
            if(menulist.style.maxHeight=='0px'){
                menulist.style.maxHeight= '100vh';
            }else{
                menulist.style.maxHeight= '0px';
            }

        }
    </script>