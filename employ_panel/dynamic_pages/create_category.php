<?php

echo '

  <div class="row">
      <div class="col-md-4 py-2 bg-white rounded-lg shadow-sm">
      <h5 class="my-3">CREATE CATEGORY
      <i class="fa fa-circle-o-notch fa-spin close d-none create-category-loader" style="font-size:18px;"></i>
      </h5>
      <form style="height:50vh;position:relative;" class="overflow-auto category-scroll p-2">
      <input type="text" class="form-control mb-3 input" placeholder="Mobiles" style="border:1px solid #ccc;background-color:#f9f9f9;" >
      <div class="category-add-field-area mb-3">
      </div>
    
    
     
      <div class="create-category-notice my-3 p-4"> 

      </div>

      </form>


      <button type="button" class="btn btn-primary mb-3 category-add-field-btn">
      <i class="fa fa-plus"></i>
      Add Fields
      </button>

      <button type="button" class="btn btn-danger mb-3 create-field-btn">
      <i class="fa fa-plus"></i>
      Create
      </button>



      </div>
      <div class="col-md-2"></div>
      <div class="col-md-6 py-2 bg-white rounded-lg shadow-sm">
          <h5 class="my-3">CATEGORY LIST</h5>
          <hr>
          <div class="category-area overflow-auto" style="height:50vh;">
          </div>
      </div>
      </div>
      </div>

  ';

?>