<?php
require "./PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/src/SMTP.php";
require "./PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth   = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Host       = "smtp.gmail.com";
$mail->Port       = 587;

// Set your SMTP credentials
$mail->Username   = "atharva.kori7@gmail.com";  // Change to your SMTP email address
$mail->Password   = "usvicugxxpdvrfkb";     // Change to your SMTP email password

$mail->isHTML(true);
return $mail;
?>