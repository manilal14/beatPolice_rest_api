<?php

include "db_config_beat.php";
$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

if(mysqli_connect_errno()){
  $response_code = -1;
  $message  = "Error from database";
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$q = "SELECT tags.id,tags.a_id,tags.t_coord, tags.t_type, tags.name, tags.des, tags.phone,
tags.gender,tags.n_name,tags.n_phone, tags.image_name FROM tags";

$response = array();
$result   = $conn->query($q);

if($result){
  $response_code = 1;
  $message = "success";
  array_push($response, array("response_code"=>$response_code,"message"=>$message));

  while ($r = $result->fetch_assoc()) {
    $t = array();
    $t['id']      = $r['id'];
    $t['a_id']      = $r['a_id'];
    $t['t_coord'] = $r['t_coord'];
    $t['t_type']  = $r['t_type'];
    $t['name']    = $r['name'];
    $t['des']     = $r['des'];

    $t['phone']   = $r['phone'];
    $t['gender']   = $r['gender'];
    $t['n_name']   = $r['n_name'];
    $t['n_phone']   = $r['n_phone'];
    $t['image_name']   = $r['image_name'];


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
