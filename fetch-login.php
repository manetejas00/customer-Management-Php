<?php
    require_once "db.php";
   
$json = array();
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $sqlQuery = "SELECT * FROM tbl_member where username= '". $username. "' and  password='". $password. "'";
    $result = mysqli_query($conn, $sqlQuery);
   
   $rows= array();
    while($res = mysqli_fetch_assoc($result)){
        $rows[] = $res;
    }
    
    
    if(!empty($rows)){
        session_start();
        $_SESSION["user_data"] = $username;
        $_SESSION["id"] = $rows[0]['id'];
        $json['status'] = 1;
    }else{
        $json['status'] = 0;
    }

    echo json_encode($json);
   
?>