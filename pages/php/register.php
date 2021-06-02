<?php

require_once("../../common_file/databases/database.php");
$f_name = $_POST['first_name'];
$l_name = $_POST['last_name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = md5($_POST['password']);
$address = $_POST['address'];
$state = $_POST['state'];
$country = $_POST['country'];
$pincode = $_POST['pincode'];

$select = "SELECT * FROM users";

$response = $db->query($select);

if($response)
{
    $insert = "INSERT INTO users(f_name,l_name,email,mobile,pass_word,adr,sta,pin_code,country)VALUES(
        '$f_name','$l_name','$email','$mobile','$password','$address','$state','$pincode','$country'
    )";
    $response = $db->query($insert);
    if($response)
    {
        require("sendsms.php");
    }
    else
    {
        echo "failed to store";
    }

}
else
{
    $create_table = "CREATE TABLE users(
        id INT(11) NOT NULL AUTO_INCREMENT,
        f_name VARCHAR(100),
        l_name VARCHAR(100),
        email VARCHAR(100),
        mobile VARCHAR(20),
        pass_word VARCHAR(150),
        status_check VARCHAR(20) DEFAULT 'pending',
        reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        adr VARCHAR(250),
        sta VARCHAR(100),
        pin_code INT(20),
        country VARCHAR(100),
        PRIMARY KEY(id)
    )";

   $response =  $db->query($create_table);
   if($response)
   {
    $insert = "INSERT INTO users(f_name,l_name,email,mobile,pass_word,adr,sta,pin_code,country)VALUES(
        '$f_name','$l_name','$email','$mobile','$password','$address','$state','$pincode','$country'
    )";
    $response = $db->query($insert);
    if($response)
    {
        require("sendsms.php");
    }
    else
    {
        echo "failed to store";
    }
   }
   else
   {
       echo "Unable to create user table";
   }
}







?>