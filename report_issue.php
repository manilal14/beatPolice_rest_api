<?php

include "db_config_beat.php";
$upload_path = 'photos/issues/';

$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');
extract($_POST);
$file_name = $_FILES['image']['name'];
mkdir($upload_path,0777,true);

if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_path.$file_name)){
    echo "success";
}else
    echo "failure";

$q = "INSERT INTO `daily_check` (`id`, `allot_id`, `tag_id`, `check`, `issue_id`, `des`, `time`, `my_pos`, `image_name`) 
VALUES (NULL, '$allot_id', '$tag_id', '$check', '$issue_id', '$des', '$time', '$my_pos', '$file_name')";

$result=$con->query($q);
if($result)
 	echo 1;
else
 	echo $con->error;

  if ($_FILES["uploaded_file"]["error"] > 0) {
        echo "Error: " . $_FILES["image"]["error"] . "<br>\n";
    } else {
        echo "Upload: " . $_FILES["image"]["name"] . "<br>\n";
        echo "Type: " . $_FILES["image"]["type"] . "<br>\n";
        echo "Size: " . ($_FILES["image"]["size"] / 1024) . " kB<br>\n";
        echo "Stored in: " . $_FILES["image"]["tmp_name"];
    }
?>
