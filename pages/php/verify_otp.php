<?php
require_once("../../common_file/databases/database.php");

session_start();

$user_otp =  $_POST['otp'];
$email = $_POST['email'];
$otp  =  $_SESSION['otp'];

if($user_otp == $otp)
{
    unset($_SESSION['otp']);
    

    //update status
    $update = "UPDATE users SET status_check='active' WHERE email='$email'";
    $response = $db->query($update);
    if($response)
    {
        echo "success";
    }
    else
    {
        echo "failed to update!";
    }
}
else
{
    echo $otp;
}


?>