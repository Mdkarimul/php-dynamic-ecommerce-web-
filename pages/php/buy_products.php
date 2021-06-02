


<?php
require_once("../../common_file/databases/database.php");
if(empty($_COOKIE['authentication']))
{
  header("Location:../../signin.php");
  exit;
}
$username = base64_decode($_COOKIE['authentication']);
$id =  $_GET['id'];
$get_data = "SELECT * FROM products WHERE id='$id'";
$response  = $db->query($get_data);
$title = "";
$price = "";
$description = "";
$brand = "";
$category = "";
$stocks = "";
$front = "";
$top = "";
$bottom = "";
$left = "";
$right = "";
if($response)
{
  $data = $response->fetch_assoc();
 $title =  $data['title'];
 $description = $data['descrip'];
$price =  $data['price'];
$brand = $data['brands'];
$category = $data['category_name'];
$stocks = $data['quantity'];
$front = $data['front'];
$top = $data['topp'];
$bottom = $data['bottom'];
$left = $data['leftt'];
$right = $data['rightt'];
}


//show and hide add cart button
 $cart_button = "";
$get_cart = "SELECT * FROM cart WHERE product_id='$id' AND username='$username'";
$response = $db->query($get_cart);
if($response->num_rows !=0)
{
 $cart_button = "";
}
else
{
  $cart_button = "<br><button class='btn btn-warning cart-btn' product_id='".$data['id']."' product_title='".$data['title']."'  product_price='".$data['price']."' product_brand='".$data['brands']."' product_pic='".$data['thumb']."'><i class='fa fa-shopping-cart'></i>ADD TO CART</button>";
}

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
  $pincode = $_SESSION['pincode'];
  $check_picode = "SELECT * FROM delivary_area WHERE pincode='$pincode'";
  $response  = $db->query($check_picode);
  $buy_btn = "";
  $cod_btn = "";
  if($response->num_rows !=0)
  {
   $data =  $response->fetch_assoc();
   
    if($data['pay_mode']=="All")
    {
     $cod_btn = '<input type="radio" name="pay-mode" value="cod"> CASH ON DELIVARY<br>';
    }
    else
    {
   $cod_btn = "";
    }

  if($stocks>0)
  {
    $buy_btn = '<button class="btn btn-warning my-2 purchase-btn  ml-3" product_id="'.$id.'"  product_title="'.$title.'" product_brand="'.$brand.'" product_price="'.$price.'">BUY NOW</button>';
  }
  else
  {
    $buy_btn = '<button class="btn btn-light border shadow-sm my-2 purchase-btn  ml-3" product_id="'.$id.'"  product_title="'.$title.'" product_brand="'.$brand.'" product_price="'.$price.'"> <i class="fa fa-shopping-cart"></i> OUT OF STOCK</button>';
  }
  }
 else
 {
 $buy_btn = "<button class='btn btn-info ml-2'>Whoops ! Product delivary not available in your area</button>";
 }

?>
<div class="container-fluid bg-white p-5 ">

<a href="#" class="text-capitalize"><?php echo $category  ?>/</a>
<a href="#" class="text-capitalize"><?php echo $brand  ?>/</a>
<a href="#" class="text-capitalize"><?php echo $title  ?></a>
<div class="row mt-3">
<div class="col-md-6  pt-4" style="background:#f6f6f6;" align="center">
<img src='<?php echo "../../".$front;  ?>' width="430" height="450"  class='mb-4 preview shadow-lg' >
<br>
<img src='<?php  echo "../../".$top;  ?>' width='140' height="100"  class='border shadow-sm thumb-pic' style="cursor:pointer;">
<img src='<?php  echo "../../".$bottom;  ?>' width='140' height="100"  class='border shadow-sm thumb-pic' style="cursor:pointer;">
<img src='<?php  echo "../../".$left;  ?>' width='140' height="120"  class='border shadow-sm thumb-pic' style="cursor:pointer;">
</div>
<div class="col-md-6 bg-white">

<h4 class="text-capitalize mt-2"><?php  echo $title;  ?></h4>
<p class="p-0 m-0"><?php echo $brand  ?></p>
<p><i class="fa fa-rupee"></i> <?php  echo $price; ?></p>
<h4>Description</h4>
<h5><?php echo $description;  ?></h5>
<br>
<h4>Quantity</h4>
<?php  

if($stocks<=5)
{
  echo "<p class='text-success font-weight-bold'>ONLY <span class='stock_number'>".$stocks."</span> in stocks</p>";
}
else
{
  echo "<p class='text-success font-weight-bold d-none'>ONLY <span class='stock_number'>".$stocks."</span> in stocks</p>";
}

?>
<input type="number" value="1" class="form-control mb-3 mt-1 quantity" style="width:80px;">

<h4>Pay mode</h4>
<div class="form-group border py-4 p-2">
<input type="radio" name="pay-mode" value="online"> ONLINE
<?php echo $cod_btn;  ?>
</div>

<?php echo $cart_button;  ?>
<?php echo $buy_btn; ?>
<br>

<h4 class="my-3">CHECK PRODUCT AVAILABILITY</h4>
<hr>
<div class="form-group py-4 px-2 shadow-lg">
<input type="number" class="form-control w-75 pincode-field mb-3" placeholder="PIN CODE">
<p class="pincode-message"></p>
<button class="btn btn-warning pincode-api-btn">PROCEED</button>
</div>
</div>

<div class='col-md-12 bg-white my-4 py-4'>
<h4>Products reviews</h4>
<?php

$get_rate = "SELECT * FROM purchase WHERE product_id='$id' AND rating <> 0";
$response  = $db->query($get_rate);

if($response)
{
  while($data =  $response->fetch_assoc())
  {
   $src =  "data:images/png;base64,".base64_encode($data['picture']);
   $fullname = $data['fullname'];
   $rating = $data['rating'];
   $comment = $data['comment'];
    echo "<div class='media pb-4'>";
    echo "<img src='".$src."' width='180' height='180' class='border p-2 shadow-sm mr-2 rounded-circle d-'>";
    echo "<div class='media-body'>";
    echo "<p class='mt-2 m-0 p-0'>".$fullname."</p>";

    for($i=0;$i<$rating;$i++)
    {
      echo "<i index='".$i."' class='star fa fa-star text-warning mr-2' style='pointer-events:none;cursor:pointer;font-size:25px;'></i>";
    }
  $rest_star = 5-$rating;
  for($i=0;$i<$rest_star;$i++)
  {
    echo "<i index='".$i."' class='star fa fa-star-o text-warning mr-2' style='pointer-events:none;cursor:pointer;font-size:25px;'></i>";
  }
  
  echo "<p>".$comment."</p>";

    echo "</div>";
    
    
    echo "</div>";
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