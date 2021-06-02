<?php
require_once("../../common_file/php/database.php");
$get_category_name = "SELECT * FROM category";
$response = $db->query($get_category_name);
$multi_result = [];
if($response)
{
while($data = $response->fetch_assoc())
{
  array_push($multi_result,$data['category_name']);
}
}



echo '

  <div class="row">
      <div class="col-md-4 py-2 bg-white rounded-lg shadow-sm">
      <h5 class="my-3">CREATE BRANDS
      <i class="fa fa-circle-o-notch fa-spin close create-brands-loader d-none" style="font-size:18px;"></i>
      </h5>
      <form style="height:50vh;position:relative;" class="brands-form overflow-auto brand-scroll p-2" >
      <select class="form-control mb-3 brands-category">
      <option disabled="disabled">Choose category</option>';



      for($i=0;$i<count($multi_result);$i++)
      {
        echo "<option>".$multi_result[$i]."</option>";
      }

   

    



      echo '</select>
      <input type="text" class="form-control mb-3 input" placeholder="Nokia" style="border:1px solid #ccc;background-color:#f9f9f9;" >
      
      <div class="brand-add-field-area">
      </div>
      
      <div class="create-brands-notice my-3 p-4"> 

      </div>
      
     
      </form>


      <button type="button" class="btn btn-primary mb-3 brand-add-field-btn">
      <i class="fa fa-plus"></i>
      Add Fields
      </button>

      <button type="submit" class="btn btn-danger mb-3 create-brands-btn">
      <i class="fa fa-plus"></i>
      Create
      </button>



      </div>
      <div class="col-md-2"></div>
      <div class="col-md-6 py-2 bg-white rounded-lg shadow-sm">
      <div class="form-group">
      <select class="form-control my-4 display-brands">
      <option disabled="disabled">Choose category</option>';

      for($i=0;$i<count($multi_result);$i++)
      {
        echo "<option>".$multi_result[$i]."</option>";
      }

echo '
      </select>
      </div>
          <h5 class="my-3">BRAND LIST <i class="fa fa-circle-o-notch fa-spin brand-loader d-none float-right mr-3"></i></h5>
          <hr>
          <div class="brands-list-show-area my-3">

          </div>
      </div>
      </div>
      </div>

  ';

?>