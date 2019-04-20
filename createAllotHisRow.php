<?php

include "db_config_beat.php";


$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME) or die('Unable to Connect...');

$allotId = $_POST['allot_id'];
$p_id    = $_POST['p_id'];

$unix    = time();

$response = array();


$q = "INSERT INTO `allot_hist` (`id`, `allot_id`, `p_id`, `login_t`, `logout_t`, `pos`) 
VALUES (NULL, '$allotId', '$p_id', '$unix', '', '')";

$result=$con->query($q);

if($result){
    $lastId = $con->insert_id;
    $rc = 1;
    $mess = "Row inserted";
   
}
else{
    $lastId = 0;
    $rc = 0;
    $mess = "failed to insert";
    
}
array_push($response,array("rc"=>$rc,"mess"=>$mess,"lastId"=>$lastId ));
echo json_encode($response);
?>
