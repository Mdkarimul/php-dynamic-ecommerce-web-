<?php
require_once("../../common_file/databases/database.php");
$id = $_POST['id'];
$email  = $_POST['email'];
$amount = $_POST['amount'];
$title = $_POST['title'];
$fullname = $_POST['fullname'];
 $address = $_POST['adr'];
 $mobile = $_POST['mobile'];
 $quantity = $_POST['quantity'];


$update = "UPDATE purchase SET statuss='dispatched' WHERE product_id='$id'";
$response = $db->query($update);
if($response)
{
 
 $message = "Hi...
 Your Order Has Shipped
 Order Details
 ".$fullname."
Product name : ".$title."
Quantity : ".$quantity."
Amount : " .$amount."
Address : ".$address."
Mobile :  ".$mobile."

THANKS  AND REGARD WAP TEAM
";

$check_mail = mail($email,"WAP SHOPPING ORDER",$message);
if($check_mail)
{
    echo "success";
}
else
{
    echo "Unable to notify users !";
}



}
else
{
    echo "Failed to update";
}



?>