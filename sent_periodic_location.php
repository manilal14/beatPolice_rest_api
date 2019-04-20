<?php

include "db_config_beat.php";

$allot_hist_id = $_POST['allot_hist_id'];
$pos = $_POST['pos'];

if($allot_hist_id == "" || $pos == ""){
    echo "not allowed from db";
    die();
}

$t = time();
$pos = $pos.$t."]";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$q = "UPDATE allot_hist SET allot_hist.pos=CONCAT(allot_hist.pos,'$pos') WHERE allot_hist.id = '$allot_hist_id'";
$result = $conn->query($q);
$response = array();

if($result){
  $response_code = 1;
  $message = "success1";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));
  echo json_encode($response);
}
else{
  $response_code = 0;
  $message = "Failure";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));
  echo json_encode($response);
}
?>