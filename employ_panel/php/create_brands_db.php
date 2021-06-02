<?php
require_once("../../common_file/php/database.php");
$category_name =  $_POST['category'];
$data = json_decode($_POST['json_data']);
$length = count($data);
$message = "";
$i;

$select_brands_table = "SELECT * FROM brands";
if($db->query($select_brands_table))
{
    for($i=0;$i<$length;$i++)
    {
        $insert = "INSERT INTO brands(category_name,brands_name)VALUE('$category_name','$data[$i]')";
        if($db->query($insert))
        {
            if(mkdir("../../stocks/".$category_name."/".$data[$i]))
            {
          $message = "done";
            }
        }
        else
        {
            $message = "failed to store";
        }
    }
    echo $message;
}
else
{
    $create_brands_table = "CREATE TABLE brands(
        id INT(10) NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(50),
        brands_name VARCHAR(50),
        PRIMARY KEY(id)
    )";
    if($db->query($create_brands_table))
    {
        for($i=0;$i<$length;$i++)
        {
            $insert = "INSERT INTO brands(category_name,brands_name)VALUE('$category_name','$data[$i]')";
            if($db->query($insert))
            {
                
                if(mkdir("../../stocks/".$category_name."/".$data[$i]))
                {
              $message = "done";
                }
            }
            else
            {
                $message = "failed to store";
            }
        }
        echo $message;
    }
    else
    {
        echo "failed to create table";
    }
}




?>