<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

if(isset($_POST["send"])){
   $name = htmlspecialchars($_POST['name']);
   $email = htmlspecialchars($_POST['email']);
   $phone = htmlspecialchars($_POST['phone']);
   $subject = htmlspecialchars($_POST['subject']);
   $message = htmlspecialchars($_POST['message']);

   try {

   $mail = new PHPMailer(true);

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'grejonagashi19@gmail.com';
   $mail->Password = 'qzxsjsseiqifclel';
   $mail->SMTPSecure = 'ssl';
   $mail->Port = 465;

   $mail->setFrom('grejonagashi19@gmail.com', 'Hotel Contact Form');
   $mail->addReplyTo($_POST['email'], $_POST['name']);

   $mail->addAddress('grejonagashi19@gmail.com');
   $mail->isHTML(true);
   $mail->Subject = $_POST["subject"];

   $mail->Body = "<p><strong>Name:</strong> {$_POST['name']}</p>
               <p><strong>Email:</strong> {$_POST['email']}</p>
               <p><strong>Phone Number:</strong> {$_POST['phone']}</p>
               <p><strong>Message:</strong><br>{$_POST['message']}</p>";
   $mail->send();

   echo "<script>
         alert('Sent Successfully');
         document.location.href = '../pages/contact.php';
         </script>";

} catch (Exception $e) {
echo "<script>
    alert('Message could not be sent');
    document.location.href = '../pages/contact.php';
    </script>";
    }
}
?>