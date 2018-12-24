<?php

include "db_config_beat.php";
$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$response = array();

$tag_id = $_POST['tag_id'];


if($tag_id == ""){
    echo "not allowed";
    die();
}

if(mysqli_connect_errno()){
  $response_code = -1;
  $message  = "Error from database";
  array_push($response, array("response_code"=>$response_code, "message"=>$message));
  echo json_encode($response);
  die();
}

$q = "SELECT daily_check.id, daily_check.des, daily_check.time FROM daily_check 
WHERE daily_check.tag_id = '$tag_id' ORDER BY id DESC";

$result   = $conn->query($q);

if($result){

  $response_code = 1;
  $message = "success";
  array_push($response, array("response_code"=>$response_code,"message"=>$message));

  while ($r = $result->fetch_assoc()) {
      
    $t = array();

    $t['id']      = $r['id'];
    $t['des']    = $r['des'];
    $t['time'] = $r['time'];
    
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
