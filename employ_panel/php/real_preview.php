<?php

$file = $_FILES['pic'];
$location = $file['tmp_name'];
$image = "data:image/png;base64,".base64_encode(file_get_contents($location));
$data = json_decode($_POST['data']);
$text_data =  "<div>".$data[0]."</div>";
$h_align =  $data[1];
$v_align = $data[2];

$text_align = "";
if($h_align =="center")
{
$text_align = "text-center";
}
else if($h_align=="flex-start")
{
    $text_align = "text-left";
}
else if($h_align=="flex-end")
{
$text_align = "text-right";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container-fluid p-0">
 <div class="carousel">
 <div class="carousel-inner">
 <div class="carousel-item active">
 <img src="<?php echo $image  ?>" class="w-100">
 <div class="carousel-caption <?php echo $text_align;  ?> h-100 d-flex" style="justify-content:<?php echo $h_align ?>; align-items:<?php echo $v_align  ?>;">
 <?php

echo $text_data;

?>
 </div>

 </div>
 </div>
 </div>
</div>
    
</body>
</html>