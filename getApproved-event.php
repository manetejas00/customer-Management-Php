<?php
require_once "db.php";

$id = $_POST['id'];
$sqlDelete = "update tbl_events set status='Approved' WHERE id=".$id;

mysqli_query($conn, $sqlDelete);
echo mysqli_affected_rows($conn);

mysqli_close($conn);
?>