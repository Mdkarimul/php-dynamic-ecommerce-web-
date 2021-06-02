
<?php  
require_once("../../common_file/databases/database.php");
echo '
<div class="row">
   <div class="col-md-3"></div>
   <div class="col-md-6 bg-white">
   <div class="jumbotron bg-white py-3">
   <h4>SET DELIVARY LOCATION</h4>
   <form class="set-area-form">
   <select require="required" name="country"  class="form-control mb-3 countries">
   <option>Choose country</option>';?>

   <?php 

 $get_countries = "SELECT * FROM countries";
 $response = $db->query($get_countries);
 if($response)
 {
   while($data  = $response->fetch_assoc())
   {
     echo "<option  c_id='".$data['id']."'>".$data['name']."</option>";
   }
 }
   ?>

   <?php 
   echo '
   </select>

   <select require="required" class="form-control mb-3 states" name="state">
   <option>Choose state</option>
   </select>

   <select class="form-control mb-3 cities" name="city">
   <option>Choose city</option>
   </select>

   <input require="required" type="number" name="pincode" class="form-control pincode mb-3" readonly placeholder="PINCODE">


   <input require="required" type="text" name="delivary_time" class="form-control delivary mb-3"  placeholder="Delivary in 5 to 10 days">


   <select class="form-control mb-3 payment-mode" name="pay_mode" require="required">
   <option disabled="disabled">Choose Pay Mode</option>
   <option>Online</option>
   <option>All</option>
   </select>
<div class="form-group">
<button class="btn btn-primary set-area-btn" type="submit">SET AREA</button>
</div>
   </form>
   </div>
   </div>
   <div class="col-md-3"></div>
   </div>';
   
   ?>