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
<h3>LOGIN WITH US</h3>
<hr>
<div class="row">
<div class="col-md-6">
<form class="signin-form">




<div class="form-group">
<label for="email">Email <sup style="color:red;font-size:15px;">*</sup></label>
<input type="email" name="email" id="email" placeholder="example@gmail.com" required="required" class="email form-control bg-light"> 
</div>



<div class="form-group">
<label for="password">Password<sup style="color:red;font-size:15px;">*</sup></label>
<input type="password" name="password" id="password"  required="required" class="form-control bg-light"> 
</div>

<div class="form-group">
<button class="btn btn-primary shadow-sm px-4 py-2" type="submit">Login</button>
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

<div class="form-group login-notice"> 

</div>




</div>
<div class="col-md-1"></div>
<div class="col-md-5">
<h4>NEW CUSTOMER</h4>
<p>if you don't have an account please register with us</p>
<a href="signup.php" class="btn btn-danger">Create an account</a>
</div>
</div>
</div>
</div>


<?php
  include_once('assets/footer.php');
?>

<script>
$(document).ready(function(){
  $(".signin-form").submit(function(e){
 e.preventDefault();
 $.ajax({
   type : "POST",
   url : "pages/php/login.php",
   data  :new FormData(this),
   processData : false,
   contentType : false,
   cache : false,
   success : function(response){
    alert(response);

    if(response.trim() =="success")
    {
     $(".otp-form").removeClass("d-none");
     $(".signin-form").addClass("d-none");


    //verify otp
   $(".verify-btn").click(function(){
     $.ajax({
       type : "POST",
       url : "pages/php/verify_otp.php",
       data : {
      otp : Number($(".otp").val().trim()),
      email : $(".email").val()
     
       },
       beforeSend : function(){
      $(this).html("Please wait...");
       },
       success : function(response){
       alert(response);

       if(response.trim() =="success")
       {
         var notice = document.createElement("DIV");
         notice.innerHTML= "<b>User verified try to login</b>";
         notice.className= "alert alert-info";
         $(".login-notice").html(notice);
         setTimeout(function(){
          $(".login-notice").html("");
          window.location = "signin.php";
         },3000);
      
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
      mobile : $(".email").val()
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
    else if(response.trim()=="Login success")
    {
      window.location = "index.php";
    }
    else
    {
      var message = document.createElement("DIV");
      message.innerHTML="<b>"+response+"</b>";
      message.className="alert alert-warning";
      $(".login-notice").html(message);
      setTimeout(function(){
        $(".login-notice").html("");
        $(".login-form").trigger('reset');
      },3000);
    }

   }
 });
  });
});
</script>

  </body>
</html>