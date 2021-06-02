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
<div class="container-fluid bg-white p-5 ">
<div class="container shadow-lg border py-4">
 <h4>PRIVACY POLICY</h4>
 <hr>
 <br>
<?php 
echo $branding_data['privacy_policy'];
?>
</div>
</div>

<?php
  include_once('assets/footer.php');
?>

  </body>
</html>