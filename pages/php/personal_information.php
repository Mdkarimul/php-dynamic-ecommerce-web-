<?php
require_once("../../common_file/databases/database.php");
$f_name = $_POST['firstname'];
$l_name = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$state=  $_POST['state'];
$country = $_POST['country'];
$pincode = $_POST['pincode'];
$address = $_POST['address'];

$username = base64_decode($_COOKIE['authentication']);

$update_data = "UPDATE users SET f_name='$f_name',l_name='$l_name',email='$email',mobile='$mobile',sta='$state',country='$country',pin_code='$pincode',adr='$address' WHERE email='$username'";
$response = $db->query($update_data);
if($response)
{
echo "update success";
}
else
{
echo "update failed";
}

?>