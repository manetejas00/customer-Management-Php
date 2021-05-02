<?php
    require_once "db.php";

    session_start();
    $user_id = $_SESSION['id'];
    $json = array();
    $sqlQuery = "SELECT id, title, start,case when Status='' then 'open' else Status end as Status, calendar_end as end FROM tbl_events WHERE CreatedBy = $user_id ORDER BY id";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);    
    echo json_encode($eventArray);
?>