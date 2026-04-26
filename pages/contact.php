<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php";?>

<div class="contact-container">
    <h2> Contact Us </h2>
    <?php if (!empty($errors)): ?>
    <div style="color: red; margin-bottom: 20px;">
        <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php endif; ?>

    <?php if ($successMsg): ?>
    <div style="color: green; margin-bottom: 20px;">
        <p><?php echo $successMsg; ?></p>
        </div>
    <?php endif; ?>
    
    <form action="contact.php" method="POST">
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