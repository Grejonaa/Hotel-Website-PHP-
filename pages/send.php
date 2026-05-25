<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

if(isset($_POST["send"])){
   $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
   $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
   $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
   $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
   $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

   if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
   die("Invalid email");
   }
   $mail = new PHPMailer(true);

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'grejonagashi19@gmail.com';
   $mail->Password = 'bspdysijavrcrnlu';
   $mail->SMTPSecure = 'ssl';
   $mail->Port = 465;

   $mail->setFrom('grejonagashi19@gmail.com', 'Hotel Contact Form');

   $mail->addRepluTo($_POST['email'], $_POST['name']);

   $mail->addAddress('grejonagashi19@gmail.com');
   $mail->isHTML(true);

   $mail->Subject = $subject;

   $mail->Body = "
   <p><strong>Name:</strong> $name</p>
   <p><strong>Email:</strong> $email</p>
   <p><strong>Phone Number:</strong> $phone</p>
   <p><strong>Message:</strong><br> $message</p>";

   $mail->send();

   echo "
   <script>
       alert('Sent Successfully');
       document.location.href = 'contact.php'
       </script>";

}
?>