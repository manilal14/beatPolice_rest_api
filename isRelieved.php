<?php

include "db_config_beat.php";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$allotId = $_POST['allot_Id'];

if($allotId==""){
    echo "No alloted id";
    die();
}



if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$unix = time();

$q = "SELECT allotement_1.relieved FROM allotement_1 WHERE allotement_1.id = '$allotId'";
$result = $conn->query($q);
$response = array();

if($result){
  $response_code = 1;
  $message = "success";

  array_push($response,array("rc"=>$response_code, "mess"=>$message));

  $row = mysqli_fetch_row($result);
  array_push($response, array("isRelieved"=>$row[0]));
 
}
else{
  $response_code = 0;
  $message = "No such allotment exits";
  array_push($response,array("rc"=>$response_code, "mess"=>$message));
}
echo json_encode($response);
?>
