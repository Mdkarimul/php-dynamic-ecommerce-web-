<?php
require_once("../../common_file/databases/database.php");
if(empty($_COOKIE['authentication']))
{
  header("Location:../../signin.php");
  exit;
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
?>
<div class="container-fluid bg-white p-5 ">

<div class="row">
<div class="col-md-8">
<div class="bg-white">
<?php
$username = base64_decode($_COOKIE['authentication']);
$get_data = "SELECT * FROM cart WHERE username='$username'";
$response = $db->query($get_data);
if($response)
{
  while($data =  $response->fetch_assoc())
  {echo "<div class='media border p-2 mb-3 shadow-sm'>
  <div class='media-left mr-2'>
  <img src='../../".$data['product_pic']."' width='100'>
  </div>

  <div class='media-body p-2 px-4'>
  <h5 class='text-capitalize m-0 p-0'>".$data['product_title']."</h5>
  <span>".$data['product_brand']."</span><br>
  <span><i class='fa fa-rupee'></i> ".$data['product_price']."</span><br>
  <div class='btn-group shadow-sm mt-2'>
  <button product_id='".$data['product_id']."' class='btn btn-danger delete-cart-btn'><i class='fa fa-trash'></i></button>
  <button product_id='".$data['product_id']."' class='btn btn-primary buy-cart-btn'>Buy Now</button>
  </div>
  </div>
  </div>";}
}
else
{
  echo "<h1 class='text-center'><i class='fa fa-shopping-cart'></i>Your catd is empty</h1>";
}


?>
</div>
</div>
<div class="col-md-4">
<div class="bg-white">
<h1>Testing 2</h1>
</div>
</div>
</div>

</div>

<?php
  include_once('../../assets/footer.php');
?>

  </body>
</html>