<?php

include "db_config_beat.php";
$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$aId = $_POST['a_id'];

if(mysqli_connect_errno()){
  $response_code = -1;
  $message  = "Error from database";
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));
  die();
}

$response_code = -1;
$message = "Error in php file";

$response = array();

$q0 = "SELECT slot_tab.slot FROM slot_tab WHERE slot_tab.slot_id = 'slot0' AND slot_tab.a_id = '$aId'";
$res = $conn->query($q0);

if($res){
  
  $row = mysqli_fetch_row($res);
  $t = array();
  $t['slot']   = $row[0];
  array_push($response,$t);
}


$q = "SELECT todo.id, todo.todo, todo.lat, todo.lon, todo.des
 FROM todo WHERE todo.active=1 AND todo.a_id = '$aId'";

$result   = $conn->query($q);



if($result)
{

  if($result->num_rows == 0){
    $response_code = 0;
    $message = "No todo available";
    array_push($response, array("response_code"=>$response_code,"message"=>$message));

  }

  else{

    $response_code = 1;
    $message = "success";
    array_push($response, array("response_code"=>$response_code,"message"=>$message));

    while ($r = $result->fetch_assoc()) {
      $t = array();

      $t['id']   = $r['id'];
      $t['todo'] = $r['todo'];
      $t['des']  = $r['des'];
      $t['lat']  = $r['lat'];
      $t['lon']  = $r['lon'];
      
      array_push($response,$t);
    }
    
    
   
    
    


}

  
}

else {
  $response_code = 0;
  $message = "failure";
  echo json_encode(array("response_code"=>$response_code, "message"=>$message));

}

echo json_encode($response);
$conn->close();

?>
