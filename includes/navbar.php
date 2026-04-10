<header>
    <div class="content flex_space">
        <div class="logo">
            <img src="../images/logo.jpeg" alt="">
        </div>
        <div class="navlinks">
            <ul id="menulist">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../pages/rooms.php">Rooms</a></li>
                <li><a href="../pages/about.php">About</a></li>
                <li><a href="../pages/contact.php">Contact</a></li>
                <li>
                    <button>
                        <a href="../pages/book.php" class="primary-btn">BOOK NOW</a>
                    </button>
                </li>
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