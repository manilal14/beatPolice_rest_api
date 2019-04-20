<?php

include "db_config_beat.php";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$response = array();

if(mysqli_connect_errno()){
  $response_code = -1;
  $message = "Error from database";
  $error = $conn->connect_error;
  array_push($response,array("response_code"=>$response_code, "message"=>$message, "error" => $error));
  echo json_encode($response);
  die();
}

$phone = $_POST['phone'];
$pass  = $_POST['pass'];
$mob_id  = $_POST['mob_id'];


$q0 = "SELECT area_1.init_fl, area_1.a_id
FROM police_1 INNER JOIN area_1
WHERE police_1.a_id = area_1.a_id 
AND police_1.p_phone = '$phone' AND police_1.p_pass = '$pass'";

$result0 = $conn->query($q0);

if($result0)
{
  $r = mysqli_fetch_row($result0);
  $init_fl = $r[0];
  $areaId  = $r[1];

  if($init_fl == "0")
  {
    $qinsert = "UPDATE area_1 set area_1.sec_id = '$mob_id', area_1.init_fl = 1 WHERE area_1.a_id = '$areaId'";
    $rinsert = $conn->query($qinsert);

    if($rinsert)
    {
      $response_code = 2;
      $message = "device registerd, login once again to continue";
      array_push($response, array("response_code"=>$response_code,"message"=>$message));
      echo json_encode($response);
    }


  }

  else
  {

    $q = "SELECT police_1.a_id, police_1.p_name, police_1.p_id, police_1.p_pic, area_1.a_name, area_1.des, area_1.coord
    FROM police_1 INNER JOIN area_1
    WHERE police_1.a_id = area_1.a_id 
    AND police_1.p_phone = '$phone' AND police_1.p_pass = '$pass' AND area_1.sec_id = '$mob_id'";
    
    $result = $conn->query($q);
    $response = array();
    
    if($result->num_rows == 1)
    {

      $row = mysqli_fetch_row($result);
      $response_code = 1;
      $message = "login_success";

      array_push($response, array(
      "response_code"=>$response_code,

      "message"=>$message,
      "a_id"=>$row[0],
      "p_name"=>$row[1],
      "p_pid"=>$row[2],
      "p_pic"=>$row[3],
      "a_name"=>$row[4],
      "a_des"=>$row[5],
      "coord"=>$row[6]));
      
      echo json_encode($response);
    
    }
    
    else 
    {
      
      $response_code = 0;
      $message = "login_failed : userId or/and password is incorrect or this device may belongs to other area";
      array_push($response, array("response_code"=>$response_code,"message"=>$message));
      echo json_encode($response);
    }

  }

}

else{

  $response_code = 0;
  $message = "login_failed : userId or/and password is incorrect or this device may belongs to other area";
  array_push($response, array("response_code"=>$response_code,"message"=>$message));
  echo json_encode($response);

}

?>
