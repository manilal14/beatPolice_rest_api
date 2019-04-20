<?php

include "db_config_beat.php";
$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$p_id = $_POST['p_id'];
$title = $_POST['n_title'];
$message = $_POST['n_message'];

$p_id = 1247;
$title = "From BeatPolice";
$message = "You have alloted Beat Area";


$q = "SELECT police_1.fcm_token FROM police_1 WHERE police_1.p_id = '$p_id'";
$result = $conn->query($q);
$row = mysqli_fetch_row($result);

$token = $row[0];
$ids = array($token);

$notificationArray = array('title'=>$title, 'body'=> $message, 'sound'=>'default');

$url = 'https://fcm.googleapis.com/fcm/send';


$fields = array (
        'registration_ids' =>
                $ids,
        'notification' => $notificationArray,
        'priority' => 'high',
        'content_available' => true
       
);

$fields = json_encode ($fields);

$headers = array (
        'Authorization: key=' . "AIzaSyAGok5sy9hAd0wz3iTHmhVtDSm1e-jyO-A",
        'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, true );
curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );


$result = curl_exec ( $ch );
echo $result;

curl_close ( $ch );
?>