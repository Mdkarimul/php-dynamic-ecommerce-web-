<?php
require_once("../../common_file/databases/database.php");

session_start();


$mobile =  $_POST['mobile'];
$email = strrchr($mobile,'@');
if($email)
{
$get_data = "SELECT mobile FROM users WHERE email='$mobile'";
$response = $db->query($get_data);
if($response)
{
    $data = $response->fetch_assoc();
   $mobile =  $data['mobile'];
}
}

$otp = rand(456789,996789);
$_SESSION['otp'] = $otp;
echo "success";


?>