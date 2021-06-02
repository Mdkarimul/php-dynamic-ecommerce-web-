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

  <script src="pages/js/index.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

*:focus
{
    box-shadow:none!important;
}

.carousel-caption
{
  line-height:80px;
  height:100%;
}

@media(max-width:576px)
{
  #top-slider h1{
    font-size:180%!important;
    margin-top:5%;
  }

  #top-slider h4{
    font-size:120%!important;
  }
  #top-slider button a
  {
    font-size:18px!important;
  }

  #category-showcase img 
  {
    width :80%;
    margin-left:10%;
    margin-right:10%;
  }
}
</style>


</head>
<body class="" style="background-color:#ddd;">
<?php
  include_once('assets/nav.php');
?>

<div class="container-fluid p-0 my-2 ">
  <div class="carousel slide" data-ride="carousel" data-interval="500" id="top-slider">
<div class="carousel-inner">

<?php

$showcase = "SELECT * FROM header_showcase";
$response  = $db->query($showcase);
if($response)
{
  while($data = $response->fetch_assoc())
  {
    $text_align = "";
    $h_align = $data['h_align'];
    $v_align = $data['v_align'];
    if($h_align =="center")
    {
      $text_align = "text-center";
    }
    else
    {
      $text_align = "text-left";
    }
    $title_color = $data['title_color'];
    $title_size = $data['title_size'];
    $subtitle_color = $data['subtitle_color'];
    $subtitle_size = $data['subtitle_size'];
    echo "<div class='carousel-item carousel-item-control'>";
   $image =  "data:image/png;base64,".base64_encode($data['title_image']);
  echo "<img src='".$image."' class='w-100'>";
  echo "<div class='carousel-caption ".$text_align." h-100' style='justify-content:".$h_align."; align-items:".$v_align."' >";
  echo "<h1 style='color:".$title_color.";font-size:".$title_size."' >".$data['title_text']."</h1>";
  echo "<h4 style='color:".$subtitle_color.";font-size:".$subtitle_size."'>".$data['subtitle_text']."</h4>";
  echo $data['buttons'];
  echo "</div>";
   echo "</div>";
  }
}

?>
</div>
</div>
</div>

<!-- start category showcase-->

<div class="container my-4" id="category-showcase">
<h4 class='my-4 text-center'>CATEGORY SHOWCASE</h4>
<div class="row">
<?php

$dir = ['top-left','bottom-left','center','top-right','bottom-right'];

$top_left_image = "";
$top_left_label = "";

$bottom_left_image = "";
$bottom_left_label = "";

$center_image = "";
$center_label = "";

$top_right_image = "";
$top_right_label = "";

$bottom_right_image = "";
$bottom_right_image = "";


for($i=0;$i<count($dir);$i++)
{
  $get_data = "SELECT * FROM category_showcase WHERE dir='$dir[$i]'";
 $response =  $db->query($get_data);
 if($response)
 {
$data = $response->fetch_assoc();

if($dir[$i] == "top-left")
{
  $top_left_image = "data:image/png;base64,".base64_encode($data['imagee']);
  $top_left_label = $data['label'];
}

else if($dir[$i] == "bottom-left")
{
  $bottom_left_image = "data:image/png;base64,".base64_encode($data['imagee']);
  $bottom_left_label = $data['label'];
}

if($dir[$i] == "center")
{
  $center_image = "data:image/png;base64,".base64_encode($data['imagee']);
  $center_label = $data['label'];
}

if($dir[$i] == "top-right")
{
  $top_right_image = "data:image/png;base64,".base64_encode($data['imagee']);
  $top_right_label = $data['label'];
}

if($dir[$i] == "bottom-right")
{
  $bottom_right_image = "data:image/png;base64,".base64_encode($data['imagee']);
  $bottom_right_label = $data['label'];
}

 }

}



echo "<div class='col-md-4'>
<div class='position-relative mb-3'>
<button class='btn bg-white p-2 shadow-lg border text-uppercase' style='position:absolute;top:50%;left:50%;transform:translate(-50% ,-50%);z-index:100;'>".$top_left_label."</button>
<img src='".$top_left_image."' width='100%' >
</div>

<div class='position-relative mb-3'>
<button class='btn bg-white p-2 shadow-lg border text-uppercase' style='position:absolute;top:50%;left:50%;transform:translate(-50% ,-50%);z-index:100;'>".$bottom_left_label."</button>
<img src='".$bottom_left_image."' width='100%' >
</div>
</div>";


echo "<div class='col-md-4'>
<div class='position-relative mb-3'>
<button class='btn bg-white p-2 shadow-lg border text-uppercase' style='position:absolute;top:50%;left:50%;transform:translate(-50% ,-50%);z-index:100;'>".$center_label."</button>
<img src='".$center_image."' width='100%' >
</div>
</div>";


echo "<div class='col-md-4'>
<div class='position-relative mb-3'>
<button class='btn bg-white p-2 shadow-lg border text-uppercase' style='position:absolute;top:50%;left:50%;transform:translate(-50% ,-50%);z-index:100;'>".$top_right_label."</button>
<img src='".$top_right_image."' width='100%' >
</div>

<div class='position-relative mb-3'>
<button class='btn bg-white p-2 shadow-lg border text-uppercase' style='position:absolute;top:50%;left:50%;transform:translate(-50% ,-50%);z-index:100;'>".$bottom_right_label."</button>
<img src='".$bottom_right_image."' width='100%' >
</div>
</div>";

?>
</div>
</div>
<!--end category showcase--> 


<div class="container-fluid bg-info" style="padding-bottom:20px;">
<div class="row">
<?php

$get_data = "SELECT * FROM products ORDER BY RAND() LIMIT 12";
$response = $db->query($get_data);
if($response)
{
while($data  = $response->fetch_assoc())
{
 $id =  $data['id'];
  echo "<div class='col-md-3 py-5' align='center'>";
  echo "<img src='".$data['thumb']."' width='250' height='316px' ><br>";
  echo "<span class='text-uppercase font-weight-bold'>".$data['brands']."</span><br>";
  //display star
  $one = [];
  $two = [];
  $three = [];
  $four = [];
  $five = [];
  $get_rating = "SELECT rating FROM purchase WHERE product_id='$id' AND rating <> 0";
  $rating_response = $db->query($get_rating);
  if($rating_response)
  {
    while($rating_data = $rating_response->fetch_assoc())
    {
     if($rating_data['rating'] ==1)
     {
       array_push($one,1);
     }
  
     else if($rating_data['rating'] ==2)
     {
       array_push($two,2);
     }
  
     else if($rating_data['rating'] ==3)
     {
       array_push($three,3);
     }
  
     else if($rating_data['rating'] ==4)
     {
       array_push($four,4);
     }
  
     else if($rating_data['rating'] ==5)
     {
       array_push($five,5);
     }
    }
  
    $c_one = count($one);
    $c_two = count($two);
    $c_three = count($three);
    $c_four = count($four);
    $c_five = count($five);
    
    $all_length = [$c_one,$c_two,$c_three,$c_four,$c_five];
  
     $max = 0;
     for($i=0;$i<count($all_length);$i++)
     {
       if($all_length[$i] >$max)
       {
         $max = $all_length[$i];
       }
     }
  
  
     if($max ==$c_one)
     {
      for($i=0;$i<1;$i++)
      {
        echo "<i class='fa fa-star text-warning'></i>";
      }
      $rest_star = 5-1;
      for($i=0;$i<$rest_star;$i++)
      {
        echo "<i class='fa fa-star-o text-warning'></i>";
      }
     }
     else if($max ==$c_two)
     {
      for($i=0;$i<2;$i++)
      {
        echo "<i class='fa fa-star text-warning'></i>";
      }
      $rest_star = 5-2;
      for($i=0;$i<$rest_star;$i++)
      {
        echo "<i class='fa fa-star-o text-warning'></i>";
      }
     }
     else if($max ==$c_three)
     {
    
      for($i=0;$i<3;$i++)
      {
        echo "<i class='fa fa-star text-warning'></i>";
      }
      $rest_star = 5-3;
      for($i=0;$i<$rest_star;$i++)
      {
        echo "<i class='fa fa-star-o text-warning'></i>";
      }

     }
     else if($max ==$c_four)
     {
    
      for($i=0;$i<4;$i++)
      {
        echo "<i class='fa fa-star text-warning'></i>";
      }
      $rest_star = 5-4;
      for($i=0;$i<$rest_star;$i++)
      {
        echo "<i class='fa fa-star-o text-warning'></i>";
      }


     }
     else if($max==$c_five)
     {
     
      for($i=0;$i<5;$i++)
      {
        echo "<i class='fa fa-star text-warning'></i>";
      }

     }
    
  
  }
  echo "<br>";
  echo "<span class='text-uppercase '>".$data['title']."</span><br>";
  echo "<span class='text-uppercase '><i class='fa fa-rupee'></i> ".$data['price']."</span><br>";
  echo "<br><button class='btn btn-danger cart-btn' product_id='".$data['id']."' product_title='".$data['title']."'  product_price='".$data['price']."' product_brand='".$data['brands']."' product_pic='".$data['thumb']."'><i class='fa fa-shopping-cart'></i>ADD TO CART</button> ";
  echo "<button class='btn btn-primary buy-cart-btn' product_id='".$data['id']."'><i class='fa fa-shopping-bag'></i>BUY NOW</button>";
  echo "</div>";
}
}


?>



</div>
</div>

<?php
  include_once('assets/footer.php');
?>

<script>
  $(document).ready(function(){
    var carousel_item = document.querySelector(".carousel-item-control");
    $(carousel_item).addClass("active");
    
  });
</script>

  </body>
</html>