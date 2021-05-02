<?php

  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */



  // Replace contact@example.com with your real receiving email address
//ini-set('display_errors','1');
//ini-set('display_startup_errors','1');
//error_reporting(E_ALL);

require_once 'class.phpmailer.php';

date_default_timezone_set('Asia/Kolkata');


$mail = new PHPMailer(); // create a new object

$mail->Host       = localhost;
$mail->SetFrom("manetejas00@gmail.com");
$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['message'];
$mail->AddAddress("manetejas00@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
  
?>
