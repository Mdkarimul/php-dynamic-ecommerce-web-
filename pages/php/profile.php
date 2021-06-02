


<?php
require_once("../../common_file/databases/database.php");


$username = $_COOKIE['authentication'];
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
<div class="col-md-12">
<ul class="nav nav-tabs">
<li class="nav-item">
<a href="#personal" class="nav-link active" data-toggle="tab">PERSONAL</a>
</li>
<li class="nav-item">
<a href="#privacy" class="nav-link " data-toggle="tab">PRIVACY</a>
</li>
<li class="nav-item">
<a href="#purchase" class="nav-link" data-toggle="tab">PURCHASE HISTORY</a>
</li>
</ul>

<div class="tab-content">
<div class="tab-pane  active py-4 px-4" id="personal">
<h1>PERSONAL INFORMATION</h1>
<?php

$get_data=  "SELECT * FROM users WHERE email='$username'";
$response = $db->query($get_data);

$first_name = "";
$last_name = "";
$email = "";
$address = "";
$state = "";
$pincode = "";
$country = "";
$mobile = "";

if($response)
{
  $data = $response->fetch_assoc();
  $first_name = $data['f_name'];
  $last_name = $data['l_name'];
  $email = $data['email'];
  $address = $data['adr'];
  $state = $data['sta'];
  $pincode = $data['pin_code'];
  $country = $data['country'];
  $mobile =  $data['mobile'];
}


?>

<div class="jumbotron py-3 my-4 bg-white shadow-sm border-right border-top border-bottom " style="border-left:5px solid blue;">
<form class="personal-form">

<div class="form-group">
<label for="firstname">FIRST NAME</label>
<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $first_name; ?>">
</div>

<div class="form-group">
<label for="lastname">LAST NAME</label>
<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $last_name; ?>">
</div>

<div class="form-group">
<label for="email">EMAIL</label>
<input type="text" name="email" id="email" class="form-control" value="<?php echo $email;  ?>">
</div>

<div class="form-group">
<label for="mobile">MOBILE</label>
<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile; ?>">
</div>

<div class="form-group">
<label for="state">STATE</label>
<input type="text" name="state" id="state" class="form-control" value="<?php echo $state;  ?>">
</div>

<div class="form-group">
<label for="country">COUNTRY</label>
<input type="text" name="country" id="country" class="form-control" value="<?php echo  $country; ?>">
</div>

<div class="form-group">
<label for="pincode">PINCODE</label>
<input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo $pincode; ?>">
</div>

<div class="form-group">
<label for="address">ADDRESS</label>
<textarea rows="4" name="address" id="address" class="form-control">
<?php

 echo $address; 

?>
</textarea>
</div>

<div class="form-group">
<button class="btn btn-primary personal-form-btn" type="submit">UPDATE</button>
</div>

</form>
</div>


</div>

<div class="tab-pane fade " id="privacy">
<h1>PRIVACY</h1>
<div class="jumbotron py-3 my-4 bg-white shadow-sm border-right border-top border-bottom " style="border-left:5px solid blue;">
<form class="privacy-form">




<div class="form-group">
<label for="oldpassword">OLD PASSWORD</label>
<input type="text" name="oldpassword" id="oldpassword" class="form-control">
</div>

<div class="form-group">
<label for="newpassword">NEW PASSWORD</label>
<input type="text" name="newpassword" id="newpassword" class="form-control">
</div>

<div class="form-group">
<label for="re_entern_newpassword">RE-ENTER NEW PASSWORD</label>
<input type="text" name="re_enter_newpassword" id="re_enter_newpassword" class="form-control">
</div>



<div class="form-group">
<button class="btn btn-primary privacy-form-btn" type="submit">UPDATE</button>
</div>

</form>
</div>
</div>

<div class="tab-pane fade " id="purchase">
<h1>PURCHASED HISTORY</h1>

<?php

$get_data = "SELECT * FROM purchase WHERE email='$username'";
$response = $db->query($get_data);
if($response->num_rows !=0)
{
while($data = $response->fetch_assoc())
{
 $title =   $data['title'];
 $id =  $data['product_id'];
 $price = $data['amount'];
 $quantity = $data['quantity'];
 $pay_mode = $data['pay_mode'];
 $date = date_create($data['purchase_date']);
 $p_date =  date_format($date,'d-m-Y');
 $status = $data['statuss'];
$rating = $data['rating'];
$comment = $data['comment'];
 $photo = "";
 //get photo

 $get_pic=  "SELECT * FROM products WHERE id='$id'";
 $response = $db->query($get_pic);
 if($response)
 {
  $data = $response->fetch_assoc();
  $photo = $data['thumb'];
 }


 echo "<div class='media border shadow-sm my-4 px-4 py-2'>";
echo "<img src='../../".$photo."' class='mr-2' width='200' >";

echo "<div class='media-body'>";
echo "<h4 class='text-uppercase'>".$title."</h4>";
echo "<p class='p-0 m-0 ' style='color:#040;'><i class='fa fa-rupee'></i>  ".$price."</p>";
echo "<p class='p-0 m-0' style='color:#040;'> Product quantity : ".$quantity."</p>";
echo "<p class='p-0 m-0' style='color:#040;'> Pay mode : ".$pay_mode."</p>";
echo "<p class='p-0 m-0' style='color:#040;'> Status : ".$status."</p>";
echo "<p class='p-0 m-0' style='color:#040;'> Purchased date  : ".$p_date."</p>";
if($status =="delivered")
{
 if($rating ==0)
 {
  echo "<h5 class=' comment-header py-2 text-success'>PLEASE RATE THR PRODUCT</h5>";
  for($i=0;$i<5;$i++)
  {
    echo "<i index='".$i."' class='star fa fa-star-o text-warning mr-2' style='cursor:pointer;font-size:25px;'></i>";
  }
  echo "<div class='form-group comment-box'>
  <label for='comment'>Comment</label>
  <textarea maxlength='100' class='form-control w-75' id='comment'></textarea>
  </div>";


  echo "<div class='form-group picture-box'>
  <label for='picture'>Picture</label>
  <input type='file' accept='image/*' id='picture' class='form-control w-75'>
  </div>";


echo "<p class='comment-info'></p>";
  echo "<br><button class=' d-none btn btn-success text-light my-3 star-btn ' p_id='".$id."'>POST</button>";

 }
 else
 {
  echo "<h5 class='py-2 text-success'>YOUR RATING</h5>";
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





 }
}
echo "</div>";
 echo "</div>";



}

}
else
{
  echo "No purchase data availabel yet ";
}

?>
</div>

</div>


</div>
</div>
</div>



<?php
  include_once('../../assets/footer.php');
?>

  </body>
</html>