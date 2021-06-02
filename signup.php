<?php
require_once("common_file/databases/database.php");

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
  include_once('assets/nav.php');
?>

<div class="container-fluid">
<div class="container p-5  shadow-lg">
<h3> CREATE AN ACCOUNT</h3>
<hr>
<div class="row">
<div class="col-md-6">
<form class="signup-form">
<div class="form-group">
<label for="first_name">First name<sup style="color:red;font-size:15px;">*</sup></label>
<input type="text" name="first_name" id="first_name" placeholder="Mr karimul" required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<label for="last_name">Last name<sup style="color:red;font-size:15px;">*</sup></label>
<input type="text" name="last_name" id="last_name" placeholder="Islam" required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<label for="email">Email <sup style="color:red;font-size:15px;">*</sup></label>
<input type="email" name="email" id="email" placeholder="example@gmail.com" required="required" class="email form-control bg-light"> 
</div>

<div class="form-group">
<label for="mobile">Mobile<sup style="color:red;font-size:15px;">*</sup></label>
<input type="number" name="mobile" id="mobile" placeholder="91+ 9749959045" required="required" class="mobile form-control bg-light"> 
</div>

<div class="form-group">
<label for="password">Password<sup style="color:red;font-size:15px;">*</sup></label>
<input type="password" name="password" id="password"  required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<label for="address">Address<sup style="color:red;font-size:15px;">*</sup></label>
<textarea name="address" id="address"  required="required" class="form-control bg-light"> </textarea>
</div>

<div class="form-group">
<label for="state">State<sup style="color:red;font-size:15px;">*</sup></label>
<input type="text" name="state" id="state"  required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<label for="country">Country<sup style="color:red;font-size:15px;">*</sup></label>
<input type="text" name="country" id="country"  required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<label for="pincode">Pin code<sup style="color:red;font-size:15px;">*</sup></label>
<input type="number" name="pincode" id="pincode"  required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<button class="btn btn-primary register-btn shadow-sm py-2 px-4" type="submit">Register now</button>
</div>
</form>


<form class="d-none otp-form">
<div class="form-group">
<div class="btn-group border shadow-sm">
<button class="btn btn-light" type="button">
<input type="number" name="otp" placeholder="123456" class="form-control otp">
</button>
<button type="button" class="btn btn-light verify-btn ">VERIFY</button>
<button type="button" class="btn btn-light resend-btn">RESEND OTP</button>
</div>
</div>
</form>


</div>
<div class="col-md-6"></div>
</div>
</div>
</div>


<?php
  include_once('assets/footer.php');
?>

<script>
$(document).ready(function(){
  $(".signup-form").submit(function(e){
 e.preventDefault();
 $.ajax({
   type : "POST",
   url : "pages/php/register.php",
   data : new FormData(this),
   processData  :false,
   contentType : false,
   cache : false,
   beforeSend : function(){
     $(".register-btn").html("Please wait...");
   },
   success : function(response) {
    $(".register-btn").html("Register now");
  alert(response);

  if(response.trim() =="success")
  {
   $(".otp-form").removeClass("d-none");
   $(".signup-form").addClass("d-none");

   //verify otp
   $(".verify-btn").click(function(){
     $.ajax({
       type : "POST",
       url : "pages/php/verify_otp.php",
       data : {
      otp : $(".otp").val().trim(),
      email : $(".email").val()
     
       },
       beforeSend : function(){
      $(this).html("Please wait...");
       },
       success : function(response){
       alert(response);

       if(response.trim() =="success")
       {
         window.location = "signin.php";
       }
       else
       {
         $(".verify-btn").html(response);
         setTimeout(function(){
           $(".verify-btn").html("VERIFY");
           $(".otp").val("");
         },3000);
       }
       }
     });
   });

//resend otp

$(".resend-btn").click(function(){
  $.ajax({
    type : "POST",
    url : "pages/php/resend_otp.php",
    data : {
      mobile : $(".mobile").val()
    },
    success : function(response){
       alert(response);
      if(response.trim() =="success")
      {
        $(".resend-btn").html("OTP has been sended !");
        setTimeout(function(){
          $(".resend-btn").html("RESEND OTP");
        },3000);
      }
      else
      {
        $(".resend-btn").html(response);
        setTimeout(function(){
          $(".resend-btn").html("RESEND OTP");
        },3000);
      }
    }
  });
});



  }
}

 });
  });
});
</script>

  </body>
</html>