


<?php

require_once("../../common_file/databases/database.php");

echo '<div class="row">';

$dir = ['top-left','bottom-left','center','top-right','bottom-right'];

$top_left_image = "../common_file/images/small_sample.png";
$top_left_label = "";

$bottom_left_image = "../common_file/images/small_sample.png";
$bottom_left_label = "";

$center_image = "../common_file/images/large_sample.png";
$center_label = "";

$top_right_image = "../common_file/images/small_sample.png";
$top_right_label = "";

$bottom_right_image = "../common_file/images/small_sample.png";
$bottom_right_label = "";


for($i=0;$i<count($dir);$i++)
{
$get_data = "SELECT * FROM category_showcase WHERE dir='$dir[$i]'";
$response =  $db->query($get_data);
if($response)
{
$data = $response->fetch_assoc();

if($dir[$i] == "top-left")
{
if($response->num_rows !=0)
{$top_left_image = "data:image/png;base64,".base64_encode($data['imagee']);
$top_left_label = $data['label'];}
}

else if($dir[$i] == "bottom-left")
{
if($response->num_rows !=0)
{ $bottom_left_image = "data:image/png;base64,".base64_encode($data['imagee']);
$bottom_left_label = $data['label'];}
}

if($dir[$i] == "center")
{if($response->num_rows !=0){
$center_image = "data:image/png;base64,".base64_encode($data['imagee']);
$center_label = $data['label'];}
}

if($dir[$i] == "top-right")
{if($response->num_rows !=0){
$top_right_image = "data:image/png;base64,".base64_encode($data['imagee']);
$top_right_label = $data['label'];}
}

if($dir[$i] == "bottom-right")
{if($response->num_rows !=0){
$bottom_right_image = "data:image/png;base64,".base64_encode($data['imagee']);
$bottom_right_label = $data['label'];}
}

}
}
?>



<?php 
echo '
<!--left top-->
<div class="col-md-4">
<div class="position-relative">
<div class="btn-group border shadow-sm position-absolute" style="width:100%;z-index:10;">
<button class="btn btn-dark position-relative" style="cursor:pointer;">
<input type="file" accept="image/*" class="upload-icon position-absolute form-control " style="width:100%;height:100%;border:1px solid red;top:0px;left:0px;opacity:0;cursor:pointer;">
<i class="fa fa-upload"></i>
</button>
<button class="btn">
<input type="text" class="form-control upload-label" placeholder="Mobile" value="'; ?><?php echo $top_left_label;  ?> <?php echo ' ">
</button>
<button class="btn btn-dark set-btn" img-dir="top-left" disabled="disabled">SET</button>
</div>
<img src="';?><?php echo $top_left_image;  ?><?php echo ' " alt="small_sample" class="w-100 mb-3">
</div>

<!--left bottom-->
<div class="position-relative">
<div class="btn-group border shadow-sm position-absolute" style="width:100%;z-index:10;">
<button class="btn btn-dark position-relative" style="cursor:pointer;">
<input type="file" accept="image/*" class="upload-icon position-absolute form-control " style="width:100%;height:100%;border:1px solid red;top:0px;left:0px;opacity:0;cursor:pointer;">
<i class="fa fa-upload"></i>
</button>
<input type="text" class="form-control upload-label" placeholder="Mobile" value="';?><?php echo $bottom_left_label  ?><?php echo ' ">
</button>
<button class="btn btn-dark set-btn" img-dir="bottom-left" disabled="disabled">SET</button>
</div>
<img src="';?><?php echo $bottom_left_image;  ?><?php echo ' " alt="small_sample" class="w-100 mb-3">
</div>

</div>
<div class="col-md-4">
<!--center-->
<div class="position-relative">
<div class="btn-group border shadow-sm position-absolute" style="width:100%;z-index:10;">
<button class="btn btn-dark position-relative" style="cursor:pointer;">
<input type="file" accept="image/*" class="upload-icon position-absolute form-control " style="width:100%;height:100%;border:1px solid red;top:0px;left:0px;opacity:0;cursor:pointer;">
<i class="fa fa-upload"></i>
</button>
<button class="btn">
<input type="text" class="form-control upload-label" placeholder="Mobile" value="' ?><?php echo $center_label; ?><?php echo ' ">
</button>
<button class="btn btn-dark set-btn" img-dir="center" disabled="disabled">SET</button>
</div>
<img src="';?><?php echo $center_image;  ?><?php echo ' " alt="large_sample" class="w-100 mb-3">
</div>

</div>
<div class="col-md-4">
<!--top-right-->
<div class="position-relative">
<div class="btn-group border shadow-sm position-absolute" style="width:100%;z-index:10;">
<button class="btn btn-dark position-relative" style="cursor:pointer;">
<input type="file" accept="image/*" class="upload-icon position-absolute form-control " style="width:100%;height:100%;border:1px solid red;top:0px;left:0px;opacity:0;cursor:pointer;">
<i class="fa fa-upload"></i>
</button>
<button class="btn">
<input type="text" class="form-control upload-label" placeholder="Mobile" value="';?><?php  echo $top_right_label; ?><?php echo ' ">
</button>
<button class="btn btn-dark set-btn" img-dir="top-right" disabled="disabled">SET</button>
</div>
<img src="';?><?php echo $top_right_image  ?><?php echo ' " alt="small_sample" class="w-100 mb-3">
</div>

<!--bottom-right-->
<div class="position-relative">
<div class="btn-group border shadow-sm position-absolute" style="width:100%;z-index:10;">
<button class="btn btn-dark position-relative" style="cursor:pointer;">
<input type="file" accept="image/*" class="upload-icon position-absolute form-control " style="width:100%;height:100%;border:1px solid red;top:0px;left:0px;opacity:0;cursor:pointer;">
<i class="fa fa-upload"></i>
</button>
<button class="btn">
<input type="text" class="form-control upload-label" placeholder="Mobile" value="';?><?php echo $bottom_right_label; ?><?php echo ' ">
</button>
<button class="btn btn-dark set-btn" img-dir="bottom-right" disabled="disabled">SET</button>
</div>
<img src=" '; ?><?php echo $bottom_right_image ?><?php echo ' " alt="small_sample" class="w-100 mb-3">
</div>
</div>
</div>';?>