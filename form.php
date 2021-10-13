<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require 'vendor/autoload.php';

/* If you installed PHPMailer without Composer do this instead: */
/*
require 'C:\PHPMailer\src\Exception.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\SMTP.php';
*/

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);
$mail = new PHPMailer();
$mail->IsSMTP(); 
$mail->Mailer = "smtp";
/* Open the try/catch block. */

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->setFrom('lokidog1797@gmail.com', 'Loki');
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "lokidog1797@gmail.com";
$mail->Password   = "Loki_1797";


$mail->addAddress('lokidog1797@gmail.com');
$mail->IsHTML(true);
$mail->Body = "Test Hello";
// $mail->AddAddress("lokidog1797@gmail.com", "recipient-name");
// $mail->SetFrom("lokidog1797@gmail.com", "from-name");
// $mail->AddReplyTo("lokidog1797@gmail.com", "reply-to-name");
// $mail->AddCC("lokidog1797@gmail.com", "cc-recipient-name");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}