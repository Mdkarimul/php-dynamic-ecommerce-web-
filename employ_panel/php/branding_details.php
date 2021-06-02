<?php

require_once("../../common_file/databases/database.php");

$file = $_FILES['brand_logo'];
$logo = "";
$location = "";
if($file['name'] =="")
{
$location = "";
$logo = "";
}
else
{
    $tmp_name = $file['tmp_name'];
    $logo =  addslashes(file_get_contents($tmp_name));
}

$brand_name = $_POST['brand_name'];
$domain_name = $_POST['domain_name'];
$mail = $_POST['email'];
$facebook_url = $_POST['facebook_url'];
$twitter_url = $_POST['twitter_url'];
$address = $_POST['address'];
$about = addslashes($_POST['about']);
$p_policy = addslashes($_POST['p_policy']);
$c_policy = addslashes($_POST['c_policy']);
$t_condition = addslashes($_POST['t_condition']);
$phone = $_POST['phone'];


$select_branding_table = "SELECT * FROM branding";
$response = $db->query($select_branding_table);
if($response)
{
    if($logo =="")
    {
        $update_data = "UPDATE branding SET brand_name='$brand_name',domain_name='$domain_name',email='$mail',facebook_url='$facebook_url',twitter_url='$twitter_url',adr='$address',phone='$phone',about_us='$about',privacy_policy='$p_policy',cookies_policy='$c_policy',terms_policy='$t_condition'";
         $response = $db->query($update_data);
         if($response)
         {
           echo "edit success";
         }
         else
         {
         echo "edit fsiled";
         }
      }
      else
      {
        $update_data = "UPDATE branding SET brand_name='$brand_name',domain_name='$domain_name',email='$mail',facebook_url='$facebook_url',twitter_url='$twitter_url',adr='$address',phone='$phone',about_us='$about',privacy_policy='$p_policy',cookies_policy='$c_policy',terms_policy='$t_condition'";
        $response = $db->query($update_data);
        if($response)
        {
          echo "edit success";
        }
        else
        {
        echo "edit fsiled";
        }
      }
}
else
{
    $create_table = "CREATE TABLE branding(
        id INT(11) NOT NULL AUTO_INCREMENT,
        brand_name VARCHAR(50),
        brand_logo MEDIUMBLOB,
        domain_name VARCHAR(100),
        email VARCHAR(100),
        facebook_url VARCHAR(255),
        twitter_url  VARCHAR(255),
        adr VARCHAR(100),
        phone INT(12),
        about_us  MEDIUMTEXT,
        privacy_policy MEDIUMTEXT,
        cookies_policy MEDIUMTEXT,
        terms_policy MEDIUMTEXT,
        PRIMARY KEY(id)
    )";
   $response =  $db->query($create_table);
   if($response)
   {
    $store_data = "INSERT INTO branding(brand_name,brand_logo,domain_name,email,facebook_url,twitter_url,adr,phone,about_us,privacy_policy,cookies_policy,terms_policy)VALUES('$brand_name','$logo','$domain_name','$mail','$facebook_url','$twitter_url','$address','$phone','$about','$p_policy','$c_policy','$t_condition')";
    $response =  $db->query($store_data);
    if($response)
    {
   echo "data store";
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