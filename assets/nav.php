<?php
session_start();
$cart_count = '';
$branding_data = '';
$get_branding_data = "SELECT * FROM branding";
$branding_response = $db->query($get_branding_data);
if($branding_response)
{
   $branding_data =  $branding_response->fetch_assoc();
}

$menu = "";
if(empty($_COOKIE['authentication']))
{
   $menu = '<a class="dropdown-item" href="signup.php"><i class="fa fa-user"></i> Sign up</a>
   <a class="dropdown-item" href="signin.php"><i class="fa fa-sign-in"></i> Sign in</a>';
}
   else
   {
     $full_name = "";
     $username = base64_decode($_COOKIE['authentication']);
     $get_data = "SELECT * FROM users WHERE email='$username'";
     $response =  $db->query($get_data);
     if($response)
     {
       $data = $response->fetch_assoc();
     $full_name =   $f_name = $data['f_name']." ".$l_name = $data['l_name'];
      $_SESSION['fullname'] = $full_name;
      $_SESSION['mobile'] = $data['mobile'];
      $_SESSION['pincode'] = $data['pin_code'];


     }
     $menu = '<a href="http://localhost/ecommerce/pages/php/profile.php" class="dropdown-item"><i class="fa fa-user"></i> '.$full_name.'</a>
     <a href="http://localhost/ecommerce/pages/php/signout.php" class="dropdown-item"><i class="fa fa-sign-out"></i>Sign out</a>';

     $get_cart = "SELECT COUNT(id) AS result FROM cart WHERE username='$username'";
   $response =   $db->query($get_cart);
   if($response->num_rows != 0)
   {
    $data =  $response->fetch_assoc();
    if($data['result'] !=0)
   {$cart_count =  '<div class="cart-notification" style="position:absolute;width:25px;height:25px;background-color:red;color:white;font-weight:bold;border-radius:50%;z-index:1000;">
    <span>'.$data['result'].'</span>
    </div>';}
   }

   }


?>

<div class="container-fluid bg-white shadow-sm px-0" style="border:1px solid red;">
<nav class="container navbar navbar-expand-sm bg-white"> 
<a href="#" class="navbar-brand">
<?php 
$logo_str =  base64_encode($branding_data['brand_logo']);
$c_src =  "data:image/png;base64,".$logo_str;
echo "<img src='".$c_src."' width='100' >";
echo "<a href='http://localhost/ecommerce/index.php' class='nav-link'>".$branding_data['brand_name']."</a>";
?>
</a>

    <div class="collapse navbar-collapse" id="menu-box">
    <ul class="navbar-nav"> 
    <?php
     $get_menu = "SELECT category_name FROM category";
     $response = $db->query($get_menu);
     if($response)
     {
         while($nav =  $response->fetch_assoc())
         {
             echo "<li class='nav-item ml-4'><a href='https://localhost/ecommerce/pages/php/products.php?cat_name=".$nav['category_name']."' class='nav-link text-uppercase text-dark'>".$nav['category_name']."</a></li>";
         }
     }
   
    ?>
    </ul>
    </div>

    <div class="btn-group ml-auto">
    <button class="btn border navbar-toggler" data-toggle="collapse" data-target="#menu-box">
    <i class='fa fa-bars'></i>
    </button>

    <button class="btn border">
    <a class="cart-link" href="http://localhost/ecommerce/pages/php/cart_new_page.php"><i class='fa fa-shopping-cart'></i></a>
    <?php echo $cart_count; ?>
    </button>

    <button class="btn border d-flex align-items-center">
    <input type="search" class="form-control search-input " style="width:300px;float:left;">
   
    </button>

    <button class="btn border search-icon">
    <i class='fa fa-search search-button'></i>
    </button>

    <div class="dropdown d-flex align-items-center">
  <button type="button" class="btn  dropdown-toggle " data-toggle="dropdown">
   <i class='fa fa-user'></i>
  </button>
  <div class="dropdown-menu">
  <?php

echo $menu;

?>
    
  </div>
</div>

<div class='position-absolute  search-hint  py-4 ' style="width:100%;z-index:60000;top:60px;"></div>


    </div>


    </nav>

 




<div class="container-fluid bg-dark py-2 border-top">
<div class="container d-flex justify-content-around">




<div class="input-group my-2 w-50"> 
<input type="email" name="subscribe-email" placeholder="example@gmail.com" class="form-control subscribe-email">
<div class="input-group-append subscribe-btn" style="cursor:pointer;">
<span class="input-group-text">SUBSCRIBE</span>
</div> 
</div>

<div class="btn-group  bg-white my-2">
<button class="btn">FOLLOW US</button>
<button class="btn border"><a href="<?php echo  $branding_data['facebook_url']; ?>"><i class="fa fa-facebook"></i></a></button>
<button class="btn border"><a href="<?php echo $branding_data['twitter_url']; ?>"><i class="fa fa-twitter"></i></a></button>

</div>

</div>
</div>





    </div>