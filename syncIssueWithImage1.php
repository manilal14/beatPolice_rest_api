<?php

include "db_config_beat.php";
$upload_path = 'photos/issue_pic/';

$allotId            = $_POST['allot_id'];
$tagId              = "0";
$check              = "0";
$issueId            = $_POST['issue_id'];
$des                = $_POST['des'];
$reportedAtTime     = $_POST['reported_at_time'];
$reportedAtLocation = $_POST['reported_at_location'];
$aId                = $_POST['a_id'];
$from               = $_POST['from'];
$to                 = $_POST['to'];
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

    $q = "INSERT INTO `daily_check` (`id`, `allot_id`, `tag_id`, `check`, `issue_id`, `des`, `time`, `my_pos`, `image_name`, 
    `a_id`, `u_from`, `u_to`, `lat`,`longi`) 
    VALUES (NULL, '$allotId', '$tagId', '$check', '$issueId', '$des', '$reportedAtTime', '$reportedAtLocation', 
    '$file_name', '$aId', '$from', '$to','$lat','$lon')";
    
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
