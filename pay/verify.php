<?php

session_start();

$id = $_GET['id'];
$title = $_GET['title'];
$brand = $_GET['brand'];
$price = $_GET['price'];
$quantity = $_GET['quantity'];
$fullname = $_GET['fullname'];
$mobile = $_GET['mobile'];
//$price = $_GET['price']*100;
//$brand = $_GET['brand'];
//$title = $_GET['title'];
//$quantity = $_GET['quantity'];
//$fullname = $_SESSION['fullname'];
//$mobile = $_SESSION['mobile'];

require('config.php');



require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
        header("Location:purchase_entry.php?id=".$id."&title=".$title."&brand=".$brand."&price=".$price."&quantity=".$quantity."&fullname=".$fullname."&mobile=".$mobile."&pay_mode=Online");
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
