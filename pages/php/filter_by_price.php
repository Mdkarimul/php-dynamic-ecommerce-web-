<?php
require_once("../../common_file/databases/database.php");
$min =  $_POST['min'];
$max = $_POST['maxx'];
$category = $_POST['cat_name'];
$all_data = [];
$get_data = "SELECT * FROM products WHERE category_name='$category' AND price BETWEEN $min AND $max ";
$response = $db->query($get_data);
if($response)

{
    while($data = $response->fetch_assoc())
    {
      array_push($all_data,$data);
    }
   echo  json_encode($all_data);
}




?>