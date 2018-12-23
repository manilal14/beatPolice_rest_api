<?php

include "db_config_beat.php";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$p_id = $_POST['p_id'];

$q = "SELECT allotement_1.id, allotement_1.a_id,allotement_1.time, area_1.a_name, area_1.des, area_1.coord
FROM allotement_1,area_1
WHERE area_1.a_id = allotement_1.a_id
AND allotement_1.p_id = '$p_id' AND allotement_1.flag = 0";

$result = $conn->query($q);
$response = array();

if($result->num_rows == 1){

  $response_code = 1;
  $message = "success";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));

  $r = $result->fetch_assoc();
  $t = array();
  $t['id']      = $r['id'];
  $t['a_id']    = $r['a_id'];
  $t['a_time']  = $r['time'];
  $t['a_name']  = $r['a_name'];
  $t['des']     = $r['des'];
  $t['coord']   = $r['coord'];

  array_push($response,$t);

  echo json_encode($response);
}

else if($result->num_rows > 1){
  $response_code = 2;
  $message = "More than one alloted area";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));

  while ($r = $result->fetch_assoc())
  {
    $t = array();
    $t['id']      = $r['id'];
    $t['a_id']    = $r['a_id'];
    $t['a_time']  = $r['time'];
    $t['a_name']  = $r['a_name'];
    $t['des']     = $r['des'];
    $t['coord']   = $r['coord'];

    array_push($response,$t);
  }
  echo json_encode($response);
}

else {
  $response_code = 0;
  $message = "failure";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));
  echo json_encode($response);
}

?>
