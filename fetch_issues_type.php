<?php

    include "db_config_beat.php";
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

    if(mysqli_connect_errno()){
        $response_code = -1;
        $message  = "Error from database";
        echo json_encode(array("response_code"=>$response_code, "message"=>$message));
        die();
    }

    $q = "SELECT * FROM issues";
    $response = array();
    $result   = $conn->query($q);

    if($result){
        $response_code = 1;
        $message = "success";
        array_push($response, array("response_code"=>$response_code,"message"=>$message));
      
        while ($r = $result->fetch_assoc()) {

          $t = array();

          $t['id']      = $r['id'];
          $t['title']   = $r['title'];
          
          array_push($response,$t);
        }
      
        echo json_encode($response);
      
      
      }
      
      else {
        $response_code = 0;
        $message = "failure";
        echo json_encode(array("response_code"=>$response_code, "message"=>$message));
      
      }     


?>