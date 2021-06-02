<?php

require_once("../../common_file/databases/database.php");

$check_table = "SELECT id,brand_name,domain_name,email,facebook_url,twitter_url,adr,phone,about_us,privacy_policy,cookies_policy,terms_policy FROM branding";
$all_data = [];
$response = $db->query($check_table);
if($response)
{
  $data =  $response->fetch_assoc();
  array_push($all_data,$data);
 echo  json_encode($all_data);
}



?>