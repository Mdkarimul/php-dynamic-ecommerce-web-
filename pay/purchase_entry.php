<?php

require_once("../common_file/databases/database.php");

$id =  $_GET['id'];
$title =  $_GET['title'];
$brand =  $_GET['brand'];
$price = $_GET['price'];
$quantity =  $_GET['quantity'];

$nav = include_once('../assets/nav.php');
  $fullname = $_SESSION['fullname'];
  $mobile = $_SESSION['mobile'];


$username = base64_decode($_COOKIE['authentication']);
$address = "";
$state = "";
$pincode = "";
$country = "";
$mode = $_GET['pay_mode'];


$date = date('Y-m-d');
$time = date('H:i:s');


$message= "";
$qnt_stock = "";
//get stocks
$get_stock = "SELECT quantity FROM products WHERE id='$id' AND brands='$brand'";
$response = $db->query($get_stock);
if($response)
{
   $data =  $response->fetch_assoc();
$qnt_stock =  $data['quantity']-$quantity;
}


$get_data = "SELECT * FROM users WHERE email='$username'";
$response = $db->query($get_data);
if($response)
{
    $data = $response->fetch_assoc();
   $adr =  $data['adr'];
   $state = $data['sta'];
   $country = $data['country'];
   $pincode = $data['pin_code'];

   $purchase_entry = "SELECT * FROM purchase";
   $response =  $db->query($purchase_entry);
   if($response)
   {
    $store = "INSERT INTO purchase(product_id,title,brand,quantity,fullname,email,amount,mobile,adr,sta,pin_code,country,pay_mode,purchase_date,purchase_time)VALUES(
        '$id','$title','$brand','$quantity','$fullname','$username','$price','$mobile','$address','$state','$pincode','$country','$mode','$date','$time'
    )";
   $response =  $db->query($store);
   if($response)
   {
     //delete from cart
     $delete_cart = "DELETE FROM cart WHERE product_id='$id' AND username='$username'";
    $response =  $db->query($delete_cart);
    if($response)
    {
          //update stock quantity 
     $update = "UPDATE products SET quantity='$qnt_stock' WHERE id='$id' AND brands='$brand'";
     $response = $db->query($update);
     if($response)
     {
         $message =  "success";
     }
     else
     {
      $messag =  "Unable to stock";
     }
    }
    else
    {
     //update stock quantity 
     $update = "UPDATE products SET quantity='$qnt_stock' WHERE id='$id' AND brands='$brand'";
     $response = $db->query($update);
     if($response)
     {
         $message  =  "success";
     }
     else
     {
      $message  =  "failed to purchase !";
     }
    }


   }
   else
   {
       echo "failed to store !";
   }
   }
   else
   {
       $creat_table = "CREATE TABLE purchase(
           id INT(20)NOT NULL AUTO_INCREMENT,
           product_id INT(25),
           title VARCHAR(250),
           brand VARCHAR(100),
           quantity INT (11),
           fullname VARCHAR(250),
           email VARCHAR(255),
           amount FLOAT(25),
           mobile INT(20),
           adr VARCHAR(255),
           sta VARCHAR(180),
           pin_code INT(20),
           country VARCHAR(150),
           pay_mode VARCHAR(50),
           purchase_date DATE,
           purchase_time TIME,
           rating INT(10) DEFAULT 0,
           comment MEDIUMTEXT NULL,
           picture MEDIUMBLOB NULL,
           statuss VARCHAR(50) DEFAULT 'Processing',
           PRIMARY KEY (id)
       )";
      $response =  $db->query($creat_table);
      if($response)
      {
       $store = "INSERT INTO purchase(product_id,title,brand,quantity,fullname,email,amount,mobile,adr,sta,pin_code,country,pay_mode,purchase_date,purchase_time)VALUES(
           '$id','$title','$brand','$quantity','$fullname','$username','$price','$mobile','$address','$state','$pincode','$country','$mode','$date','$time'
       )";
      $response =  $db->query($store);
      if($response)
      {
        //delete from cart
        $delete_cart = "DELETE FROM cart WHERE product_id='$id' AND username='$username'";
       $response =  $db->query($delete_cart);
       if($response)
       {
             //update stock quantity 
        $update = "UPDATE products SET quantity='$qnt_stock' WHERE id='$id' AND brands='$brand'";
        $response = $db->query($update);
        if($response)
        {
            $message =  "success";
        }
        else
        {
         $messag =  "Unable to stock";
        }
       }
       else
       {
        //update stock quantity 
        $update = "UPDATE products SET quantity='$qnt_stock' WHERE id='$id' AND brands='$brand'";
        $response = $db->query($update);
        if($response)
        {
            $message  =  "success";
        }
        else
        {
         $message  =  "failed to purchase !";
        }
       }


      }
      else
      {
          echo "failed to store !";
      }
      }
      else
      {
          echo "unable to create table";
      }
   }


}


require_once("../common_file/databases/database.php");
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

*:focus
{
    box-shadow:none!important;
}
</style>


</head>
<body class="" style="background-color:#ddd;">
<?php
  
echo $nav;

?>
<div class="container-fluid bg-white p-5 ">
<div class="jumbotron bg-white border-right border-top border-bottom shadow-sm " style="border-left:5px solid #47e20a">

<center>
<?php 
if($message =="success")
{
echo '<i class="fa fa-check-circle" style="font-size:100px;color:#47e20a;"></i>';
}
else
{
    echo '<i class="fa fa-times-circle" style="font-size:100px;color:red;"></i>';
}
?>
<h4><?php echo $message;  ?></h4>
<p>PLEASE OPEN YOUR EMAIL TO GET MORE INFORMATION </p>
<a href="http://localhost/ecommerce/index.php"><button class="btn btn-warning py-2 px-3">SHOP MORE</button></a>
</center>
</div>
</div>

<?php
  include_once('../assets/footer.php');
?>

  </body>
</html>