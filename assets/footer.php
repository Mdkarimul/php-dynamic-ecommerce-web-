

<div class='container-fluid'>
<div class="row">
<div class="col-md-12">

<div class="form-group d-flex justify-content-center py-5">
<div class='input-group w-50 '>
<input type="email" style="height:50px;background:#020;" placeholder="email@gmail.com" name="subscribe-email" class="subscribe-email form-control">
<div class='input-group-append subscribe-btn'>
<span class='input-group-text bg-primary text-light border-left-0' style='cursor:pointer;'>SUBSCRIBE</span>
</div>
</div>
</div>

</div>
</div>
</div>



<div class="container-fluid bg-dark text-light border" style="height:400px;">
<div class="container py-5">
<div class="row">
<div class="col-md-3">
<h5 class="">CATEGORY</h5>
<?php
    
    $get_menu = "SELECT category_name FROM category";
    $response = $db->query($get_menu);
    if($response)
    {
        while($nav =  $response->fetch_assoc())
        {
            echo "<a href='#' class=' d-block py-2 text-capitalize text-light nav-link ml-0 pl-0'>".$nav['category_name']."</a>";
        }
    }
  
   ?>


</div>
<div class="col-md-1"></div>
<div class="col-md-3 text-light">
<h5>POLICIES</h5>
<a href="privacy.php" class="d-block py-2 text-light  nav-link ml-0 pl-0">Privacy policy</a>
<a href="cookies.php" class="d-block py-2 text-light nav-link ml-0 pl-0">Cookies policy</a>
<a href="terms.php" class="d-block py-2 text-light nav-link ml-0 pl-0">Terms & Conditions</a>
</div>
<div class="col-md-1"></div>
<div class="col-md-4">
<h5>CONTACTS</h5>
<p>VENUE :  <?php echo $branding_data['adr'];  ?></p>
<p>CALL :  <?php echo $branding_data['phone'];   ?></p>
<p>Email : <?php echo $branding_data['email']  ?> </p>
<p>Website : <?php  echo $branding_data['domain_name']  ?> </p>

</div>
</div>
</div>
</div>
