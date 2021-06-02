<?php

require_once("../../common_file/php/database.php");

$dir = '';
$message = '';
$c_name = $_GET['c_name'];
$product_title =  $_POST['product_title'];
$brand_name =  $_POST['brand_name'];
$description =  $_POST['description'];
$price  = $_POST['price'];
$quantity =  $_POST['quantity'];

$date = date(Y-m-d);

//get category name here

$get_category_name = "SELECT category_name FROM brands WHERE brands_name = '$brand_name'";
$response = $db->query($get_category_name);
if($response)
{
 $data = $response->fetch_assoc();
}



$all_files = [$_FILES['thumb'],$_FILES['front'],$_FILES['bottom'],$_FILES['top'],$_FILES['left'],$_FILES['right']];
$length = count($all_files);
$file_path = ['thumb','front','bottom','topp','leftt','rightt'];

$check_dir = is_dir("../../stocks/".$data['category_name']."/".$brand_name."/".$product_title);
if($check_dir)
{
    echo "Product already exit";
}
else
{
$dir = mkdir("../../stocks/".$data['category_name']."/".$brand_name."/".$product_title);
}


$select = "SELECT * FROM products";

$response = $db->query($select);

if($response)
{
    $store_data = "INSERT INTO products(category_name,brands,title,descrip,price,quantity,datee)VALUE('$c_name','$brand_name','$product_title','$description','$price','$quantity','$date')";
    $response =  $db->query($store_data);
    if($response)
    {
        $current_id = $db->insert_id;
        //echo "data store";
    if($dir)
    {
    for($i=0;$i<$length;$i++)
    {
       $file =  $all_files[$i];
      $filename =  $file['name'];
      $location =   $file['tmp_name'];

      $current_url = "stocks/".$data['category_name']."/".$brand_name."/".$product_title."/".$filename;
      if(move_uploaded_file($location,"../../stocks/".$data['category_name']."/".$brand_name."/".$product_title."/".$filename))
      {
      $update = "UPDATE products SET $file_path[$i]='$current_url' WHERE id='$current_id'";
      $response = $db->query($update);
      if($response)
      {
          $message =   "success";
      }
     else 
      {
          $message =   "failed to update";
      }
      }
    }
    echo $message;
    }
      
    }
    else
    {
       echo   "data not store";
    }
    
    
}
else
{
    
   $create = "CREATE TABLE products(
       id  INT(10) NOT NULL AUTO_INCREMENT,
       category_name VARCHAR(50),
       brands VARCHAR(50),
       title VARCHAR(100),
       descrip VARCHAR(255),
       price FLOAT(20),
       quantity INT(10),
       thumb VARCHAR(100),
       front VARCHAR(100),
       topp VARCHAR(100),
       bottom VARCHAR(100),
       leftt VARCHAR(100),
       rightt VARCHAR(100),
       datee DATE NULL,
       PRIMARY KEY(id)
   )";

  $response =  $db->query($create);
  if($response)
  {
      
      $store_data = "INSERT INTO products(category_name,brands,title,descrip,price,quantity,datee)VALUE('$c_name','$brand_name','$product_title','$description','$price','$quantity','$date')";
     $response =  $db->query($store_data);
     if($response)
     {
         
         
        $current_id = $db->insert_id;
        if($dir)
        {
        for($i=0;$i<$length;$i++)
        {
           $file =  $all_files[$i];
          $filename =  $file['name'];
          $location =   $file['tmp_name'];
          $current_url = "stocks/".$data['category_name']."/".$brand_name."/".$product_title."/".$filename;
          if(move_uploaded_file($location,"../../stocks/".$data['category_name']."/".$brand_name."/".$product_title."/".$filename))
          {
      $update = "UPDATE products SET $file_path[$i]='$current_url' WHERE id='$current_id'";
      $response = $db->query($update);
      if($response)
      {
          $message =   "success";
      }
     else 
      {
          $message =    "failed to update";
      }
          }
        }
        echo $message;
     
        }
       

     }
     else
     {
         echo "data not store";
     }
     
    
  }
  else
  {
      echo "table not created";
  }
  


}




?>