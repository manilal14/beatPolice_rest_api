<?php

include "db_config_beat.php";
$upload_path = 'photos/issue_pic/';

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
$q_executed   = 0;
$all_success  = 0;
$response = array();


$time = time();

$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');

mkdir($upload_path,0777,true);

$imageExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION );
$file_name = $time.$pId.".".$imageExt;

if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_path.$file_name))
{
    $pic_uploaded = 1;

    $q = "INSERT INTO `issue_log_1` (`id`, `p_id`, `a_id`, `type`, `u_from`, `u_to`, `reported_at_time`, `reported_at_location`, 
    `image_path`, `des`, `lat`, `longi`)
    VALUES (NULL, '$pId', '$aId','$issueType', '$from', '$to', '$reportedAtTime', '$reportedAtLocation','$file_name',
    '$des', '$lat', '$lon')";
    
    $result=$con->query($q);
    
    if($result){
        $q_executed = 1;
        $all_success = 1;
    }
    else
        $q_executed = 0;
}

array_push($response,array("pic_uploaded"=>$pic_uploaded,"q_executed"=>$q_executed,"all_success"=>$all_success));
echo json_encode($response);
   
?>
