<?php

include "db_config_beat.php";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$allot_hist_id = $_POST['allot_hist_id'];

if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$unix = time();

$q = "UPDATE allot_hist SET allot_hist.logout_t='$unix' WHERE allot_hist.id = '$allot_hist_id'";
$result = $conn->query($q);
$response = array();

if($result){
  $response_code = 1;
  $message = "successfully logout";
  array_push($response,array("rc"=>$response_code, "mess"=>$message));
  echo json_encode($response);
}
else{
  $response_code = 0;
  $message = "Failure";
  array_push($response,array("rc"=>$response_code, "mess"=>$message));
  echo json_encode($response);
}
?>
