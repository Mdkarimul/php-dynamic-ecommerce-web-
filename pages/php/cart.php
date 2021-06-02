<?php 
header("Access-Control-Allow-Origin:*");
require_once("../../common_file/databases/database.php");
$id = $_POST['product_id'];
$title = $_POST['product_title'];
$price = $_POST['product_price'];
$brand = $_POST['product_brand'];
$pic = $_POST['product_pic'];
$username  = base64_decode($_COOKIE['authentication']);
session_start();
$get_data = "SELECT * FROM cart WHERE product_id='$id' AND username='$username'";

$response = $db->query($get_data);
if($response)
{
    if($response->num_rows ==0)
    {
    $store = "INSERT INTO cart(product_id,product_title,product_brand,product_price,product_pic,username)VALUES(
        '$id','$title','$brand','$price','$pic','$username'
    )";
   $response =  $db->query($store);
   if($response)
   {
    echo "success";
   }
   else
   {
  echo "failedll to store";
   }
   }
   else
   {
    echo "Product already in your cart";
   }
}
else
{
    $create_table = "CREATE TABLE cart(
        id INT(11) NOT NULL AUTO_INCREMENT,
        product_id INT(10),
        product_title VARCHAR(200),
        product_brand VARCHAR(100),
        product_price FLOAT(20),
        product_pic VARCHAR(250),
        username VARCHAR(200),
        PRIMARY KEY(id)
    )";
   $response =  $db->query($create_table);
   if($response)
   {
     $store = "INSERT INTO cart(product_id,product_title,product_brand,product_price,product_pic,username)VALUES(
         '$id','$title','$brand','$price','$pic','$username'
     )";
    $response =  $db->query($store);
    if($response)
    {
     echo "success";
    }
    else
    {
   echo "failed to store";
    }
   }
   else
   {
echo "table not created!";
   }
}


?>