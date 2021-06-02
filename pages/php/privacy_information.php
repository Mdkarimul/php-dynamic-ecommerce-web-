<?php 

require_once("../../common_file/databases/database.php");

$old_password =  md5($_POST['oldpassword']);
$new_password = md5($_POST['newpassword']);
$username = base64_decode($_COOKIE['authentication']);

$check_pass = "SELECT * FROM users WHERE email='$username' AND pass_word='$old_password'";
$response = $db->query($check_pass);

if($response->num_rows !=0)
{
  $update_pass = "UPDATE users SET pass_word='$new_password' WHERE email='$username'";
  $response = $db->query($update_pass);
  if($response)
  {
      echo "Password changed";
  }
  else
  {
      echo "password update failed";
  }
}
else
{
echo "your old password is wrong !";
}

?>