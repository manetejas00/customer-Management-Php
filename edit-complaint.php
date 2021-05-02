<?php
require_once "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$mob = $_POST['mob'];
$address = $_POST['address'];
$Complaint = $_POST['Complaint'];
$CreatedBy = isset($_POST['ModifiedBy']) ? $_POST['ModifiedBy'] : "";
$CreatedDate = isset($_POST['ModifiedDate']) ? $_POST['ModifiedDate'] : "";

$sqlUpdate = "UPDATE tbl_complain SET name='" . $name . "',email='" . $email . "',mob='" . $mob . "' ,address='" . $address . "',Complaint='" . $Complaint . "'
,ModifiedBy='" . $CreatedBy . "',ModifiedDate='" . $CreatedDate . "' WHERE id=" . $id;

mysqli_query($conn, $sqlUpdate);
mysqli_close($conn);

?>
