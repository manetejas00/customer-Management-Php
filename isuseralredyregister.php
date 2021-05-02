<?php
    require_once "db.php";
   
$json = array();
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $mob = isset($_POST['mob']) ? $_POST['mob'] : "";

    $sqlQuery = "SELECT * FROM tbl_member where username= '". $username. "' or  email='". $email. "' or  mob='". $mob. "'";
    $result = mysqli_query($conn, $sqlQuery);
   
   $rows= array();
    while($res = mysqli_fetch_assoc($result)){
        $rows[] = $res;
    }
    
    
    if(!empty($rows)){
        $json['status'] = 1;
    }else{
        $json['status'] = 0;
    }

    echo json_encode($json);
   
?>