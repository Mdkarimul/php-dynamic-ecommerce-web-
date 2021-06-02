<?php
require_once("../../common_file/databases/database.php");
$file = "";
$image = "";
if($_FILES)
{
$file = $_FILES['photo'];
$image =  addslashes(file_get_contents($file['tmp_name']));
}
$text = $_POST['text'];
$dir = $_POST['direction'];


$get_data = "SELECT * FROM category_showcase WHERE dir='$dir'";
$response = $db->query($get_data);
if($response)
{
   if($response->num_rows !=0)
   {
       if($file != "")
       {
       $update_data = "UPDATE category_showcase SET imagee='$image',label='$text',dir='$dir' WHERE dir='$dir'";
      $response =  $db->query($update_data);
      if($response)
      {
          echo "usuccess";
      }
      else
      {
          echo "Failed to update";
      }
    }
    else
    {
        $update_data = "UPDATE category_showcase SET label='$text',dir='$dir' WHERE dir='$dir'";
        $response =  $db->query($update_data);
        if($response)
        {
            echo "usuccess";
        }
        else
        {
            echo "Failed to update";
        }
    }
   }
   else
   {
    $store = "INSERT INTO category_showcase(imagee,label,dir)VALUES(
        '$image','$text','$dir'
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
}
else
{
    $create_table = "CREATE TABLE category_showcase (
        id INT(11) NOT NULL AUTO_INCREMENT,
        imagee MEDIUMBLOB,
        label VARCHAR(50),
        dir VARCHAR(50),
        PRIMARY KEY(id) 
    )";
   $response =  $db->query($create_table);
   if($response)
   {
    $store = "INSERT INTO category_showcase(imagee,label,dir)VALUES(
    '$image','$text','$dir'
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
       echo "Unable to create table";
   }
}


?>