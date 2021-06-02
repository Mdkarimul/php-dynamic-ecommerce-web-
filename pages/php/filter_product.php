<?php

require_once("../../common_file/databases/database.php");

$category = $_POST['cat_name'];
$brands =  $_POST['brand_name'];
if($brands !="all")
{
$get = "SELECT * FROM products WHERE brands='$brands' AND category_name='$category'";
$response = $db->query($get);
$all_data = [];
if($response)
{
   
    while($data = $response->fetch_assoc())
    {
         array_push($all_data,$data);
    }
   echo  json_encode($all_data);  
}
}
else
{

    $get = "SELECT * FROM products WHERE  category_name='$category'";
    $response = $db->query($get);
    $all_data = [];
    if($response)
    {
       
        while($data = $response->fetch_assoc())
        {
             array_push($all_data,$data);
        }
       echo  json_encode($all_data);  
    }

}


?>