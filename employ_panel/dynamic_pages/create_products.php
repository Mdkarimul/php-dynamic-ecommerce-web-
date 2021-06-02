<?php
require_once("../../common_file/php/database.php");




echo '

<form class="create-products-form">
  <div class="row">
  <div class="progress d-none  create-products-progress" style="width:90%;height:10px;">
  <div class="progress-bar"></div>
  </div>
      <div class="col-md-6 py-2 bg-white rounded-lg shadow-sm">
      <h5 class="my-3">CREATE PRODUCTS
      <i class="fa fa-circle-o-notch fa-spin close d-none" style="font-size:18px;"></i>
      </h5>
      <input type="text" required="required" name="product_title" class="form-control mb-3" placeholder="Enter Product Title" style="border:1px solid #ccc;background-color:#f9f9f9;" >
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4 py-2 bg-white rounded-lg shadow-sm">
         <br><br>
         <select name="brand_name"  class="form-control my-2 selected-products">
         <option>Choose Brands</option>';

         $get_data = "SELECT * FROM brands";
         $response = $db->query($get_data);
         if($response)
         {
         while($data =  $response->fetch_assoc())
         {
           echo "<option c-name='".$data['category_name']."'>".$data['brands_name']."</option>";
         }
         }
         else
         {

         }

         echo '
         </select>
      </div>
      </div>
      </div>

      <div class="row">
<div class="col-md-12 mb-2">
<div class="form-group my-2">
<label>Description</label>
<textarea name="description" required="required" class="form-control" rows="6"></textarea>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Price</label>
<input type="number" name="price" required="required" class="form-control" placeholder="Price">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Quantity</label>
<input type="number" name="quantity" required="required"  class="form-control" placeholder="Quantity">
</div>
</div>

<div class="row">
<div class="col-md-12 d-flex">
<div class="thumb">
<input type="file" required="required" name="thumb">
<h6>THUMB PIC</h6>
</div>

<div class="front">
<input type="file" required="required" name="front">
<h6>FRONT PIC</h6>
</div>

<div class="top">
<input type="file" required="required" name="top">
<h6>TOP PIC</h6>
</div>

<div class="bottom">
<input type="file" required="required" name="bottom">
<h6>BOTTOM PIC</h6>
</div>

<div class="right">
<input type="file" required="required" name="right">
<h6>RIGHT PIC</h6>
</div>

<div class="left">
<input type="file" required="required" name="left">
<h6>LEFT PIC</h6>
</div>


</div>
</div>
      </div>



      <button type="submit" class="float-right btn btn-primary">SUBMIT</button>
</form>
  ';

?>