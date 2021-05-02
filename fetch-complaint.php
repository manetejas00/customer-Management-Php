<?php
    require_once "db.php";

    $json = array();
    $CreatedBy = isset($_POST['CreatedBy']) ? $_POST['CreatedBy'] : "";
    $IsAdmin = isset($_POST['IsAdmin']) ? $_POST['IsAdmin'] : "";
    if ($IsAdmin !="Admin") {
        $sqlQuery = "SELECT t.id,t.name,t.email,t.mob,t.address,t.Complaint,t.Status,(select name from tbl_member where id=t.CreatedBy ) as CretedBy,t.CreatedDate,
                    (select name from tbl_member where id=t.ModifiedBy ) as ModifiedBy,T.ModifiedDate FROM tbl_complain t where t.CreatedBy= '". $CreatedBy. "'";
    }
    else{
         $sqlQuery = "SELECT t.id,t.name,t.email,t.mob,t.address,t.Complaint,t.Status,(select name from tbl_member where id=t.CreatedBy ) as CretedBy,t.CreatedDate,
                    (select name from tbl_member where id=t.ModifiedBy ) as ModifiedBy,T.ModifiedDate FROM tbl_complain t";
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