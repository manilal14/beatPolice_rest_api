<?php

include "db_config_beat.php";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$allot_id = $_POST['allot_id'];

if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$unix = time();

$q = "UPDATE allotement_1 SET allotement_1.flag = 1 WHERE allotement_1.id = '$allot_id'";
$result = $conn->query($q);
$response = array();

if($result){
  $response_code = 1;
  $message = "successfully set";
  
}
else{
  $response_code = 0;
  $message = "Failure";
 
}

array_push($response,array("rc"=>$response_code, "mess"=>$message));
echo json_encode($response);

?>
