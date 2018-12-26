<?php

include "db_config_beat.php";
$upload_path = 'photos/tags/';

$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');
extract($_POST);


$unix = time();
$date = date("d/n/Y", $unix);
$time = date("g:iA", $unix);

$response = array();

$file_name = $_FILES['image']['name'];
mkdir($upload_path,0777,true);
if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_path.$file_name)){
    array_push($response,array("pic_uploaded"=>1));
}else{
    array_push($response,array("pic_uploaded"=>0));
}

$q = "INSERT INTO `tags` (`id`, `p_id`, `a_id`, `t_coord`, `time`, `date`, `t_type`, `name`, `des`, `phone`, `gender`, `n_name`, `n_phone`, `image_name`)
VALUES (NULL, '$p_id', '$a_id', '$t_coord', '$time', '$date', '$t_type', '$name', '$des', '$phone', '$gender', '$n_name', '$n_phone', '$file_name')";

$result=$con->query($q);
if($result){
     $lastId = $con->insert_id;
     array_push($response,array("tag_inserted"=>1,"tag_id"=>$lastId ));
}
else{
    array_push($response,array("tag_inserted"=>0));
}

echo json_encode($response);
?>
