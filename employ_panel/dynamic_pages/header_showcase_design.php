<?php

require_once("../../common_file/databases/database.php");

echo '    <div class="row">
<div class="col-md-4 p-4 bg-white rounded-lg shadow-sm">
<form class="header-showcase-form">

<div class="form-group">
<label for="title_image">Title image <span> 200kb (1920*978) </span></label>
<input  type="file" accept="image/*" name="title_image" id="title_image" required="required"  class="form-control">
</div>

<div class="form-group">
<label for="title_text">Title text <span class="title_limit">0</span><span>/40</span></label>
<textarea required="required" class="form-control" maxlength="40" rows="3" id="title_text" name="title_text"></textarea>
</div>

<div class="form-group">
<label for="subtitle_text">Subtitle text <span class="subtitle_count">0</span><span>/100</span></label>
<textarea required="required" class="form-control" rows="5" maxlength="100" id="subtitle_text" name="subtitle_text"></textarea>
</div>

<div class="form-group">
<label for="create_button">Create buttons</label>
<i class="fa fa-trash delete-btn close mr-2 d-none" style="cursor:pointer;"></i>
<div id="create_button" class="input-group mb-2">
<input type="url" name="btn-url" class="form-control btn-url" placeholder="https://www.wap.com">
<input type="text" name="btn-name" class="form-control btn-name" placeholder="Button 1">
</div>

<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">BG COLOR</span>
</div>
<input type="color" name="btn-color" class="form-control btn-bgcolor">

<div class="input-group-prepend">
<span class="input-group-text">TEXT COLOR</span>
</div>
<input type="color" name="btn-textcolor" class="form-control btn-textcolor">
</div>


<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">SIZE</span>
</div> 
<select class="form-control btn-size">
<option value="16px">SMALL</option>
<option value="20px">MEDIUM</option>
<option value="24px">LARGE</option>
</select>

<div class="input-group-append">
<span class="input-group-text bg-danger add-btn text-light" style="cursor:pointer;">Add</span>
</div>
</div>



</div>


<div class="form-group">
<button class="btn btn-primary py-2 add-showcase-btn" type="submit">Add showcase</button>

<button class="btn btn-primary py-2 bg-danger real-preview-btn" type="button">Real preview</button>
</div>

<div class="form-group">
<label for="edit-title">Edit title</label>
<i class="fa fa-trash delete-title d-none close"></i>
<select class="form-control" id="edit-title">
<option>Choose title</option>'; ?>


<?php

$get_data = "SELECT * FROM header_showcase";
$response = $db->query($get_data);
$count = 0;
if($response)
{
  while($data = $response->fetch_assoc())
  {
    $count +=1;
  echo  "<option value='".$data['id']."'>".$count."</option>";
  }
}

 ?>


 <?php 

 echo '   </select>
</div>


</form>
</div>

<div class="col-md-1"></div>

<div class="col-md-7 p-4 bg-white border rounded-lg shadow-sm position-relative showcase_preview d-flex">
<div class="title-box">
<h1 class="showcase-title target">TITLE</h1>
<h4 class="showcase-subtitle target">SUBTITLE</h4>
<div class="title-buttons"></div>
</div>




<div class="showcase-formating d-flex justify-content-around align-items-center bg-success">
<div class="btn-group">
<button class="btn btn-light">Color</button>
<button class="btn btn-light">
<input type="color" class="color_selector" name="color-selector">
</button>
</div>

<div class="btn-group">
<button class="btn btn-light">Font size</button>
<button class="btn btn-light">
<input type="range" class="font-size" min="100" max="500" name="font_size">
</button>
</div>


<button class="btn btn-light dropdown-toggle" data-toggle="dropdown">
<span>Alignments</span>
<div class="dropdown-menu">
<span class="dropdown-item alignment" align-position="h" position-value="flex-start">LEFT</span>
<span class="dropdown-item alignment" align-position="h" position-value="center">CENTER</span>
<span class="dropdown-item alignment" align-position="h" position-value="flex-end">RIGHT</span>
<span class="dropdown-item alignment" align-position="v" position-value="flex-start">TOP</span>
<span class="dropdown-item alignment" align-position="v" position-value="flex-end">BOTTOM</span>
<span class="dropdown-item alignment" align-position="v" position-value="center">V-CENTER</span>
</div>
</button>

</div>
</div>

</div>

</div>';

?>