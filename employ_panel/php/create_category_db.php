<?php
require_once("../../common_file/php/database.php");

$data = json_decode($_POST['json_data']);

$length = count($data);
$i;
$message ='';

$sql = "SELECT * FROM category";
if($db->query($sql))
{
    for($i=0;$i<$length;$i++)
    {
       $insert = "INSERT INTO category(category_name)
       VALUE('$data[$i]')";
       if($db->query($insert))
       {
           
          if(mkdir("../../stocks/".$data[$i]))
          {
              $message =  "done";
          }
           
       }
       else 
       {
           $message =  "failed to store";
       }
    }

    echo $message;

}
else
{
    $create = "CREATE TABLE category(
        id INT(10) NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(50),
        PRIMARY KEY(id)
    )";
   $response =  $db->query($create);

   if($response)
   {
     for($i=0;$i<$length;$i++)
     {
        $insert = "INSERT INTO category(category_name)
        VALUE('$data[$i]')";
        if($db->query($insert))
        {
          
              if(mkdir("../../stocks/".$data[$i]))
              {
                $message =  "done";
              }
           
        }
        else 
        {
            $message =  "failed to store";
        }
     }
     echo $message;

   }
   else
   {
     echo   "Unable to create table";
   }



}



?>