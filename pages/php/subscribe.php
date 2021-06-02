<?php

require_once("../../common_file/databases/database.php");

$email = $_POST['email'];
$date = date('Y-m-d');

$store_data = "SELECT * FROM subscriber";
$response = $db->query($store_data);
if($response)
{
    $store = "INSERT INTO subscriber(email,subscribe_date)VALUES('$email','$date')";
    $response =  $db->query($store);
    if($response)
    {
   echo "success";
    }
    else
    {
    echo "Unable to subscribe please try again later";
    }
}
else
{
    $create_table = "CREATE TABLE subscriber(
        id INT(11) NOT NULL AUTO_INCREMENT,
        email VARCHAR(200) ,
        subscribe_date DATE ,
        PRIMARY KEY(id)
    )";
  $response =   $db->query($create_table);
  if($response)
  {
    $store = "INSERT INTO subscriber(email,subscribe_date)VALUES('$email','$date')";
   $response =  $db->query($store);
   if($response)
   {
  echo "success";
   }
   else
   {
   echo "Unable to subscribe please try again later";
   }
  }
  else
  {
      echo "Unable to subscribe please try again later";
  }
}


?>