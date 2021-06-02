<?php

require_once("../../common_file/databases/database.php");

$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$pay_mode = $_POST['pay_mode'];
$delivary_time = $_POST['delivary_time'];


$check_table = "SELECT * FROM delivary_area";
$response = $db->query($check_table);
if($response)
{
    $store = "INSERT INTO delivary_area(country,sta,city,pincode,delivary_time,pay_mode)VALUES(
        '$country','$state','$city','$pincode','$delivary_time','$pay_mode'
    )";
    $response = $db->query($store);
    if($response)
    {
      echo "store";
    }
    else
    {
       echo "failed to store";
    }
}
else
{
    $create_table = "CREATE TABLE delivary_area(
        id INT(11) NOT NULL AUTO_INCREMENT,
        country VARCHAR(100),
        sta VARCHAR(100),
        city VARCHAR(100),
        pincode INT(12),
        delivary_time VARCHAR(255),
        pay_mode VARCHAR(20),
        PRIMARY KEY(id)
    )";
   $response =  $db->query($create_table);
   if($response)
   {
     $store = "INSERT INTO delivary_area(country,sta,city,pincode,delivary_time,pay_mode)VALUES(
         '$country','$state','$city','$pincode','$delivary_time','$pay_mode'
     )";
     $response = $db->query($store);
     if($response)
     {
       echo "store";
     }
     else
     {
        echo "failed to store";
     }
   }
   else
   {
   echo "Enable to created !";
   }
}

?>