<?php
 include "db_config_beat.php";
 $upload_path = 'profilePic/';

 $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');

 //to get extension of image file
 $fileinfo  = pathinfo($_FILES['image']['name']);
 $extension = $fileinfo['extension'];

 $p_id = $_POST['p_id'];

 $file_name = $p_id.".".$extension;
 mkdir($upload_path,0777,true);

 if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_path.$file_name)){
   echo "success";
 }else
   echo "failure";

$q = "UPDATE `police_1` SET police_1.p_pic = '$file_name' WHERE police_1.p_id = '$p_id'";
$result=$con->query($q);

if($result)
  echo 1;
else
  echo $con->error;



?>
