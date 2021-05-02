<?php

require_once 'class.phpmailer.php';

date_default_timezone_set('Asia/Kolkata');
$message_projecttype=$_POST['projecttype'];
$message_name=$_POST['name'];
$message_email=$_POST['email'];
$message_mobileno=$_POST['Mobile'];
$message_budget=$_POST['Budget'];
$message_query=$_POST['message'];
//Plain text body
$message .= "Hi Patil Group,\n\n Requesting quotation for the project done \n"; 
$message.="\n Project Name:". $message_projecttype ."\n";
$message.="\n Name:". $message_name ."\n";
$message.="\n Email:". $message_email ."\n";
$message.="\n Mobile No:". $message_mobileno ."\n";
$message.="\n Budget:". $message_budget ."\n";
$message.="\n Query:". $message_query ."\n";
$message.="\n\nRegards,\nYour Name";
$message .= "\r\n\r--" . $message_name . "\r\n";




$mail = new PHPMailer(); // create a new object

$mail->Host       = localhost;
$mail->SetFrom("patilbuilders79@gmail.com");
$mail->Subject = "Letter requesting price quote";
$mail->Body = $message;
$mail->AddAddress("patilbuilders79@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
  
?>
