<?php
   session_start();
require "db.php";

   
   require 'vendor/autoload.php';
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   //Load Composer's autoloader
   require 'PHPMailer/src/Exception.php';
   require 'PHPMailer/src/PHPMailer.php';
   require 'PHPMailer/src/SMTP.php';
   
   //Instantiation and passing `true` enables exceptions
   $mail = new PHPMailer(true);
$name = isset($_POST['name']) ? $_POST['name'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$mob = isset($_POST['mob']) ? $_POST['mob'] : "";
$address = isset($_POST['address']) ? $_POST['address'] : "";
$Complaint = isset($_POST['Complaint']) ? $_POST['Complaint'] : "";

$Status = isset($_POST['Status']) ? $_POST['Status'] : "";
$CreatedBy = isset($_POST['CreatedBy']) ? $_POST['CreatedBy'] : "";
$CreatedDate = isset($_POST['CreatedDate']) ? $_POST['CreatedDate'] : "";


$sqlInsert = "INSERT INTO tbl_complain (name,email,mob,address,Complaint,Status,CreatedBy,CreatedDate) VALUES ('".$name."','".$email ."','".$mob ."','".$address ."','".$Complaint ."','".$Status ."' ,'".$CreatedBy ."' ,'".$CreatedDate ."')";

$result = mysqli_query($conn, $sqlInsert);
       try {
           //Server settings
           $mail->SMTPDebug = 2; //Enable verbose debug output
           $mail->isSMTP(); //Send using SMTP
           $mail->Host = 'smtp.googlemail.com';  //Set the SMTP server to send through
           $mail->SMTPAuth = true; //Enable SMTP authentication
           $mail->Username = '42.2018.Tejasmane@gmail.com'; //SMTP username
           $mail->Password = 'Tejas@1230'; //SMTP password
           $mail->SMTPSecure = 'ssl'; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
           $mail->Port = 465; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

           //Recipients
           $mail->setFrom('manetejas00@gmail.com', 'Tejas');
           $mail->addAddress('manetejas00@gmail.com', 'Tejas'); //Add a recipient
           $mail->addReplyTo('manetejas00@gmail.com', 'Tejas');
           //Content
           $mail->isHTML(true); //Set email format to HTML
           $mail->Subject = 'Complaint | Registered';
           $mail->Body = 'Name : '.$_POST['name'].'<br>Email: '.$_POST['email'].'<br>Mobile no.: '.$_POST['mob'].'<br>address: '.$_POST['address'].'<br>Complaint: '.$_POST['Complaint'];
        //    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

           $mail->send();
        //    echo 'Message has been sent';
       } catch (Exception $e) {
        //    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       }

if (! $result) {
    $result = mysqli_error($conn);
}
?>
