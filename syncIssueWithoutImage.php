<?php

include "db_config_beat.php";

$pId                = $_POST['p_id'];
$aId                = $_POST['a_id'];
$issueType          = $_POST['issue_type'];
$from               = $_POST['from'];
$to                 = $_POST['to'];
$reportedAtTime     = $_POST['reported_at_time'];
$reportedAtLocation = $_POST['reported_at_location'];
$des                = $_POST['des'];
$lat                = $_POST['lat'];
$lon                = $_POST['lon'];

$pic_uploaded = 0;
$q_executed = 0;
$all_success = 0;

$mess = "";
$response = array();

$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');

$q = "INSERT INTO `issue_log_1` (`id`, `p_id`, `a_id`, `type`, `u_from`, `u_to`, `reported_at_time`, `reported_at_location`, 
`image_path`, `des`, `lat`, `longi`)
VALUES (NULL, '$pId', '$aId','$issueType', '$from', '$to', '$reportedAtTime', '$reportedAtLocation','',
'$des', '$lat', '$lon')";

$result=$con->query($q);

if($result){
    $mess = "Only Query Executed as no image was there";
    $q_executed = 1;
}

else{
    $mess = "Failed";
    $q_executed = 0;
}

array_push($response,array("pic_uploaded"=>$pic_uploaded,"q_executed"=>$q_executed,"all_success"=>$all_success,"mess"=>$mess));
echo json_encode($response);


?>
