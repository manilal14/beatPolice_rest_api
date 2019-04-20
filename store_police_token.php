<?php 

include "db_config_beat.php";
$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$p_id = $_POST["p_id"];
$token  = $_POST["fcm_token"];

if($p_id == "" || $token == ""){
	echo "not allowed";
	die();
}

$response = array();
if (mysqli_connect_errno()) {
    $response_code = -1;
    $message = "Error from database";
    array_push($response, array("rc"=>$response_code,"mess"=>$message));
	echo json_encode($response);
    die();
}

$q = "UPDATE `police_1` SET `fcm_token` = '$token' WHERE `police_1`.`p_id` = '$p_id'";

$result = $conn->query($q);
$response = array();
	
if($result){
    $message = "success";
	$response_code = 1;
	array_push($response, array("rc"=>$response_code,"mess"=>$message));
    echo json_encode($response);
}
else{
	$response_code = 0;
    $message = "fcm token cant be updated";
    array_push($response, array("rc"=>$response_code,"mess"=>$message));
	echo json_encode($response);
}

$conn->close();

?>
