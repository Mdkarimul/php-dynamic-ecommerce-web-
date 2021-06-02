<?php

require_once("../../common_file/databases/database.php");


$email = $_POST['email'];
$password = md5($_POST['password']);


$get_data = "SELECT * FROM users WHERE email='$email'";
$response = $db->query($get_data);

if($response)
{
   if($response->num_rows !=0)
   {
    $data =  $response->fetch_assoc();
    $status =   $data['status_check'];
    $real_username = $data['email'];
    $real_password = $data['pass_word'];


    if($status =="pending")
    {
      $mobile =  $data['mobile'];
      require("sendsms.php");
    }
    else
    {
        //echo "active";
        if($real_username == $email && $real_password == $password)
        {
        session_start();
        $_SESSION['username'] = $email;
        $cookie_data = base64_encode($email);
        $cookie_time = time()+(60*60*24*365);
        setcookie("authentication",$cookie_data,$cookie_time,'/');
        
         echo "Login success";
        }
        else
        {
            echo "Wrong password !";
        }
    }
   }
   else
   {
       echo "User not found !";
   }
}
else
{
    echo " table not found !";
}


?>