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


$q = "SELECT allotement_1.id, allotement_1.a_id,allotement_1.time, allotement_1.relieved,allotement_1.date,allotement_1.date_2,
allotement_1.slot_id, area_1.a_name, area_1.des, area_1.coord
FROM allotement_1,area_1
WHERE area_1.a_id = allotement_1.a_id
AND allotement_1.p_id = '$p_id' AND allotement_1.flag = 0 AND allotement_1.relieved = 0";

      $result = $conn->query($q);
       $r = $result->fetch_assoc();
       $d_today=date("d-m-Y");
 $time=date("h:i:s");
      $time=strtotime($time);
       $d1=$r['date_2'];
       $d2=$r['date'];
      
$response = array();
$datetime1 = strtotime($d1);
$datetime2 = strtotime($d_today);
$datediff = $datetime1 - $datetime2;
$a1=round($datediff / (60 * 60 * 24));
$date1 = strtotime($d2);
$date2 = strtotime($d_today);
$datediff1 = $date1 - $date2;
$a2=round($datediff1 / (60 * 60 * 24));

if($a1>=0 && $a2<=0 )
{
    if($result->num_rows == 1){

  $response_code = 1;
  $message = "success";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));


  $t = array();
  $t['id']           = $r['id'];
  $t['a_id']         = $r['a_id'];
  $t['a_time']       = $r['time'];
  $t['is_relieved']  = $r['relieved'];
  $t['slot_id']      = $r['slot_id'];
  $t['a_name']       = $r['a_name'];
  $t['des']          = $r['des'];
  $t['coord']        = $r['coord'];
  $t['cur_time']     = $time;
  $t['date_start']   = $d2;
  $t['date_end']     = $d1;

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
  $message = "No allotment found";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));
  echo json_encode($response);
}
}

else {
  $response_code = -2;
  $message = "Either your allotment date is not started or finished";
  array_push($response,array("response_code"=>$response_code, "message"=>$message));
  echo json_encode($response);
}

?>
