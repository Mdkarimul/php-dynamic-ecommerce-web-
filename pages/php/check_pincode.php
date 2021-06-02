<?php
require_once("../../common_file/databases/database.php");
$pin =  $_POST['pin'];

$get = "SELECT * FROM delivary_area WHERE pincode='$pin'";
$response = $db->query($get);
if($response->num_rows != 0)
{
$data = $response->fetch_assoc();
echo $data['delivary_time'];
}
else
{
  echo "Whoops ! Delivary not available";
}

?>