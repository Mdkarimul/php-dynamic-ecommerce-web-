<?php
//require('textlocal.class.php');
session_start();

$otp = rand(456789,996789);
$_SESSION['otp'] = $otp;
echo "success";
/*
$textlocal = new Textlocal(false,false,'OGIyZmM2YzE4OTk1YjkyMDA0NzhmYTQ0YWE2MzI1MmU=');

$numbers = array($mobile);
$sender = 'TXTLCL';
$otp = rand(456789,996789);
$_SESSION['otp'] = $otp;
$message = 'This is otp is'.$otp;

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    echo "success";
   // print_r($result);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
*/
?>