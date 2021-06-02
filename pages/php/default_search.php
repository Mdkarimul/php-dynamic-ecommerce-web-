




<?php
require_once("../../common_file/databases/database.php");
if(empty($_COOKIE['authentication']))
{
  header("Location:../../signin.php");
  exit;
}

$key = $_GET['search'];

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

<script src='../js/index.js'></script>
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
  include_once('../../assets/nav.php');
  
?>


<div class="container-fluid bg-white p-5 ">
<div class='row'>
<div class='col-md-12 p-4 d-flex justify-content-between flex-wrap'>
<?php

$get_data = "SELECT * FROM products WHERE title LIKE '%%$key%' LIMIT 12 ";
$response = $db->query($get_data);
if($response->num_rows !=0)
{
  while($data = $response->fetch_assoc())
  {
    echo "<div class='text-center border shadow-sm p-3 mb-4'>";
   echo "<img src='../../".$data['thumb']."' width='250' height='316' >";
   echo "<br><span class=' my-1 text-upppercase font-weight-bold'>".$data['brands']."</span>";
   echo "<br><span class=' my-1 text-upppercase'>".$data['title']."</span>";
   echo "<br><span class=' my-1 text-upppercase'><i class='fa fa-rupee'></i> ".$data['price']."</span>";
   echo "<br><button class='btn btn-warning my-2 cart-btn  ml-3' product_id='".$data['id']."'  product_title='".$data['title']."' product_brand='".$data['brands']."' product_price='".$data['price']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>'";
   echo "<button class='btn btn-primary my-2 buy-cart-btn  ml-3' product_id='".$data['id']."'  product_title='".$data['title']."' product_brand='".$data['brands']."' product_price='".$data['price']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>'";
   
   echo "</div>";
  }
}
else
{
  $get_data = "SELECT * FROM products WHERE category_name LIKE '%%$key%' LIMIT 12 ";
$response = $db->query($get_data);
if($response->num_rows !=0)
{
  while($data = $response->fetch_assoc())
  {
    echo "<div class='text-center border shadow-sm p-3 mb-4'>";
   echo "<img src='../../".$data['thumb']."' width='250' height='316' >";
   echo "<br><span class=' my-1 text-upppercase font-weight-bold'>".$data['brands']."</span>";
   echo "<br><span class=' my-1 text-upppercase'>".$data['title']."</span>";
   echo "<br><span class=' my-1 text-upppercase'><i class='fa fa-rupee'></i> ".$data['price']."</span>";
   echo "<br><button class='btn btn-warning my-2 cart-btn  ml-3' product_id='".$data['id']."'  product_title='".$data['title']."' product_brand='".$data['brands']."' product_price='".$data['price']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>'";
   echo "<button class='btn btn-primary my-2 buy-cart-btn  ml-3' product_id='".$data['id']."'  product_title='".$data['title']."' product_brand='".$data['brands']."' product_price='".$data['price']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>'";
   
   echo "</div>";
  }
}
else
{
  $get_data = "SELECT * FROM products WHERE brands LIKE '%%$key%' LIMIT 12 ";
$response = $db->query($get_data);
if($response->num_rows !=0)
{
  while($data = $response->fetch_assoc())
  {
    echo "<div class='text-center border shadow-sm p-3 mb-4'>";
   echo "<img src='../../".$data['thumb']."' width='250' height='316' >";
   echo "<br><span class=' my-1 text-upppercase font-weight-bold'>".$data['brands']."</span>";
   echo "<br><span class=' my-1 text-upppercase'>".$data['title']."</span>";
   echo "<br><span class=' my-1 text-upppercase'><i class='fa fa-rupee'></i> ".$data['price']."</span>";
   echo "<br><button class='btn btn-warning my-2 cart-btn  ml-3' product_id='".$data['id']."'  product_title='".$data['title']."' product_brand='".$data['brands']."' product_price='".$data['price']."'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>'";
   echo "<button class='btn btn-primary my-2 buy-cart-btn  ml-3' product_id='".$data['id']."'  product_title='".$data['title']."' product_brand='".$data['brands']."' product_price='".$data['price']."'><i class='fa fa-shopping-bag'></i> BUY NOW</button>'";
   
   echo "</div>";
  }
}
else
{
  echo "Product found !";
}
}
}

?>
</div>
</div>

</div>



<?php
  include_once('../../assets/footer.php');
?>

  </body>
</html>