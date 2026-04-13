<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php ";?>

<div class="contact-contaner">
    <h2> Contact Us </h2>
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
    <label for="message"> Subject: </label>
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