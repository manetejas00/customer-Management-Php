<?php
    require_once "db.php";

    $json = array();
     $username = isset($_POST['username']) ? $_POST['username'] : "";
    $sqlQuery = "SELECT * FROM tbl_member where username= '". $username. "'";
    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
    echo json_encode($eventArray);
?>