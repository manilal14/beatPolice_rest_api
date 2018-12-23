<?php

include "db_config_beat.php";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);


if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  echo json_encode(array("response_code"=>$response_code, "message"=>$message, "error" => $error));
  die();
}

$p_id = $_POST['p_id'];
$pass = $_POST['pass'];



$q = "SELECT police_1.a_id,police_1.p_name, police_1.p_phone, police_1.p_pic,
area_1.a_name, area_1.des, area_1.coord
FROM police_1, area_1
WHERE police_1.a_id = area_1.a_id
AND police_1.p_id = '$p_id' AND police_1.p_pass ='$pass'";

$result = $conn->query($q);
$response = array();

if($result->num_rows == 1){

  $row = mysqli_fetch_row($result);

  $response_code = 1;
  $message = "login_success";

  array_push($response, array(
    "response_code"=>$response_code,
    "message"=>$message,

    "a_id"=>$row[0],
    "p_name"=>$row[1],
    "p_phone"=>$row[2],
    "p_pic"=>$row[3],
    "a_name"=>$row[4],
    "a_des"=>$row[5],
    "coord"=>$row[6]));


    echo json_encode($response);
}

else {
  $response_code = 0;
  $message = "login_failed : userId or/and password is incorrect";

  array_push($response, array("response_code"=>$response_code,"message"=>$message));
  echo json_encode($response);
}





?>
