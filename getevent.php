<?php
    require_once "db.php";
    $CreatedBy = isset($_POST['CreatedBy']) ? $_POST['CreatedBy'] : "";
    $IsAdmin = isset($_POST['IsAdmin']) ? $_POST['IsAdmin'] : "";
$json = array();
    if ($IsAdmin !="Admin") {
    
    $sqlQuery = "SELECT id, title, CONCAT(CONCAT(start,' ', starttime ) ,'-', CONCAT(end,' ', endtime)) as startend,
    (select Category from tbl_categeory where ID=tbl_events.category) as category,
    list,Status FROM tbl_events WHERE CreatedBy = $CreatedBy ORDER BY id";
    }
else
{
     $sqlQuery = "SELECT id, title, CONCAT(CONCAT(start,' ', starttime ) ,'-', CONCAT(end,' ', endtime)) as startend,
    (select Category from tbl_categeory where ID=tbl_events.category) as category,
    list,Status FROM tbl_events  ORDER BY id";
}

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);    
    echo json_encode($eventArray);
?>
