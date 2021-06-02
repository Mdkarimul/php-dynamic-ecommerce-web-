<?php

$email = $_POST['email'];
$code = rand(4569,84810);

$c_mail =  mail($email,"Verification code","Your verification code is :".$code);
if($c_mail)
{
    
    $data = ["success",$code];
  echo   json_encode($data);
}
else
{
    echo "failed to send email";
}

?>