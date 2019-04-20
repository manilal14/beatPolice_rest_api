<?php

include "db_config_beat.php";

$todoId     = $_POST['todo_id'];
$pId        = $_POST['p_id'];
$aId        = $_POST['a_id'];
$type       = $_POST['type'];
$from       = $_POST['from'];
$to         = $_POST['to'];
$reportedAt = $_POST['reported_at'];
$des        = $_POST['des'];
$lat        = $_POST['lat'];
$lon        = $_POST['lon'];

$slot        = $_POST['slot'];
$date        = $_POST['date'];


$pic_uploaded = 0;
$q_executed = 0;
$all_success = 0;

$mess = "";

$response = array();


$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');

$q = "INSERT INTO `todo_log_1` (`id`, `todo_id`, `p_id`, `a_id`, `type`, `u_from`, `u_to`, `reported_at`,
`image_path`, `des`, `lat`, `longi`,`slot`,`date`)
VALUES (NULL, '$todoId', '$pId', '$aId', '$type', '$from', '$to', '$reportedAt', '', '$des', '$lat', '$lon','$slot','$date')";

$result=$con->query($q);

if($result){
    $q_executed = 1;
}

else{
    $q_executed = 0;
}

array_push($response,array("pic_uploaded"=>$pic_uploaded,"q_executed"=>$q_executed,"all_success"=>$all_success));
echo json_encode($response);


?>
