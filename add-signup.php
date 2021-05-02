<?php
require "db.php";

$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$mob = isset($_POST['mob']) ? $_POST['mob'] : "";
$address = isset($_POST['address']) ? $_POST['address'] : "";
$gender = isset($_POST['gender']) ? $_POST['gender'] : "";
$dob = isset($_POST['dob']) ? date('Y-m-d', strtotime($_POST['dob'])) : "";
$IsAdmin='User';

$sqlInsert = "INSERT INTO tbl_member (username,password,email,mob,address,gender,dob,IsAdmin) VALUES ('".$username."','".$password."','".$email ."','".$mob ."','".$address ."','".$gender ."','".$dob ."','".$IsAdmin ."')";

$result = mysqli_query($conn, $sqlInsert);

if (! $result) {
    $result = mysqli_error($conn);
}
?>