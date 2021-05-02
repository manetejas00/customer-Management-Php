<?php
session_start();
require "db.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";
$category = isset($_POST['category']) ? $_POST['category'] : "";
$starttime = isset($_POST['starttime']) ? $_POST['starttime'] : "";
$endtime = isset($_POST['endtime']) ? $_POST['endtime'] : "";
$list = isset($_POST['list']) ? $_POST['list'] : "";


$calendar_end = isset($_POST['end']) && ($_POST['end'] == $_POST['start']) ? date('Y-m-d', strtotime($_POST['end']." +1 days")) : $_POST['end'];

$sqlInsert = "INSERT INTO tbl_events (title,start,end, calendar_end, CreatedBy,category,starttime,endtime,list) VALUES('".$title."','".$start."','".$end ."', '".$calendar_end."', '".$_SESSION['id']."','".$category."','".$starttime."','".$endtime."','".$list."')";

$result = mysqli_query($conn, $sqlInsert);

if (! $result) {
    $result = mysqli_error($conn);
}
?>