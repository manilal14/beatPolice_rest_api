 <?php

 include "db_config_beat.php";

 $upload_path = 'photos/';

 $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');
 extract($_POST);

 $upload_path = $upload_path."/".$p_id."/";

 $file_name = $_FILES['image']['name'];
 mkdir($upload_path,0777,true);

 if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_path.$file_name)){
 	echo "success";
 }else
 	echo "failure";

$q = "INSERT INTO `tag_1`(`p_id`, `a_id`,`t_title`, `t_coord`, `image_url`, `t_des`, `t_time`, `t_date`)
 VALUES ('$p_id','$a_id','$title','$latlng','$file_name','$des','$t_time','$t_date')";

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
