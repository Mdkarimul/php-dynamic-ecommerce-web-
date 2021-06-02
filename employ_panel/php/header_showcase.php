<?php
require_once("../../common_file/databases/database.php");

$location = "";
$f_binary = "";


$file = "";
if($_FILES)
{
    $file = $_FILES['file_data'];
    $location = $file['tmp_name'];
    $f_binary = addslashes(file_get_contents($location));
}


$all_data = json_decode($_POST['css_data'],true);
//$tmp_data = json_decode($json_data);
//$all_data = json_decode($tmp_data);

//print_r($all_data);

$title_size = $all_data['title_size'];
$title_color=  $all_data['title_color'];
$title_text = addslashes($all_data['title_text']);

$options = $all_data['options'];


$subtitle_size = $all_data['subtitle_size'];
$subtitle_color = $all_data['subtitle_color'];
$subtitle_text = addslashes($all_data['subtitle_text']);

$h_align = $all_data['h_align'];
$v_align = $all_data['v_align'];
$buttons = addslashes($all_data['buttons']);


$select = "SELECT count(id) AS result FROM header_showcase";

$response = $db->query($select);
if($response)
{
   $data =  $response->fetch_assoc();
  $count_rows  = $data['result'];
  if($count_rows< 3)
  {
if($options =="Choose title")
{
    $store = "INSERT INTO header_showcase(title_image,title_text,title_color,title_size,subtitle_text,subtitle_color,subtitle_size,h_align,v_align,buttons)
    VALUES('$f_binary','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_color','$subtitle_size','$h_align','$v_align','$buttons')";
    $response = $db->query($store);
    if($response)
    {
        echo "store";
    }
    else
    {
        echo "Enable to store";
    }
  }
  else
  {
      if($file=="")
      {
          $update_data = "UPDATE header_showcase SET title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$options'";
         $response =  $db->query($update_data);
         if($response)
         {
             echo "Update success";
         }
         else
         {
             echo "Update failed";
         }
      }
      else
      {
        $update_data = "UPDATE header_showcase SET title_image='$f_binary',title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$options'";
        $response =  $db->query($update_data);
        if($response)
        {
            echo "Update success";
        }
        else
        {
            echo "Update failed";
        }
      }
  }
  }

  else
  {
    if($options =="Choose title")
    {
      echo "Limit Full !";
    }
    else
    {
        if($file=="")
        {
            $update_data = "UPDATE header_showcase SET title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$options'";
           $response =  $db->query($update_data);
           if($response)
           {
               echo "Update success";
           }
           else
           {
               echo "Update failed";
           }
        }
        else
        {
          $update_data = "UPDATE header_showcase SET title_image='$f_binary',title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',buttons='$buttons' WHERE id='$options'";
          $response =  $db->query($update_data);
          if($response)
          {
              echo "Update success";
          }
          else
          {
              echo "Update failed";
          }
        } 
    }
  }
}
else
{
    $create_table = "CREATE TABLE header_showcase(

        id INT(11) NOT NULL AUTO_INCREMENT,
        title_image MEDIUMBLOB,
        title_text VARCHAR(255),
        title_color VARCHAR(20),
        title_size VARCHAR(10),
        subtitle_text VARCHAR(255),
        subtitle_color VARCHAR(20),
        subtitle_size VARCHAR(10),
        h_align VARCHAR(20),
        v_align VARCHAR(20),
        buttons MEDIUMTEXT,
        PRIMARY KEY(id)
    )";

   $response =  $db->query($create_table);
   if($response)
   {
    $store = "INSERT INTO header_showcase(title_image,title_text,title_color,title_size,subtitle_text,subtitle_color,subtitle_size,h_align,v_align,buttons)
    VALUES('$f_binary','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_color','$subtitle_size','$h_align','$v_align','$buttons')";
    $response = $db->query($store);
    if($response)
    {
        echo "store";
    }
    else
    {
        echo "Enable to store";
    }
   }
   else
   {
       echo "Table not created";
   }
}

?>