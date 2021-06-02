<?php
require_once("../common_file/databases/database.php");
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

  <link type="text/css" rel="stylesheet" href="css/index.css">
  <script  src="js/indexx.js"></script>
</head>
<body>
    <div class="container-fluid"> 
      <div class="sidebar">

      <button class="active btn w-100 text-left collapse-item" access-link="branding_design.php" style="font-size:20px;">
      <i class="fa fa-image"></i>
      Branding details
      </button>

      <button class=" btn w-100 text-left collapse-item" access-link="delivary_area_design.php" style="font-size:20px;">
      <i class="fa fa-map-marker mr-2"></i>
      Delivary Area
      </button>

      <button class="btn w-100 text-left homepage-design-btn" style="font-size:20px;">
      <i class="fa fa-home"></i>
      Homepage design 
      <i class="fa fa-angle-down close mt-2"></i>
      </button>
      <ul class="collapse homepage-design-collapse">
      <li class="border-left p-2 collapse-item" access-link="header_showcase_design.php">Header showcase</li>
      <li class="border-left p-2 collapse-item" access-link="category_showcase.php">Category showcase</li>
      
      </ul>



      <button class="  stock-update-btn btn w-100 text-left" style="font-size:20px;">
      <i class="fa fa-shopping-cart"></i>
      Stock update
      <i class="fa fa-angle-down close mt-2"></i>
      </button>

      <ul class="collapse stock-update-btn-menu">
      <li class="border-left p-2 collapse-item" access-link="create_category.php">Create Category</li>
      <li class="border-left p-2 collapse-item" access-link="create_brands.php">Create brands</li>
      <li class="border-left p-2 collapse-item" access-link="create_products.php">Create products</li>
      </ul>
      </div>
      <div class="page">
   

   
       <div class="row">
       <div class="col-md-12 d-flex justify-content-between">


       <div class="btn-group border bg-white shadow">
       <button class="btn bg-white">SORT BY</button>
       <button class="btn bg-white">
       <select class="form-control sort-by">
       <option>All data</option>
       </select>
       </button>

       <button class="btn btn-dark d-all">DISPATCH ALL</button>
         </div>

         <div class="btn-group border bg-white shadow">
       <button class="btn bg-white">EXPORT TO</button>
       <button class="btn bg-white">
       <select class="form-control sort-by">
       <option>Choose format</option>
       <option>pdf</option>
       <option>xls</option>
       </select>
       </button>
         </div>


       </div>
       </div>




      <div class="row my-4">
      <div class="col-md-12">
      <div class="table-responsive">
      <table class="w-100 purchase-table text-center table table-bordered bg-light">
      <tr>
      <th>S/NO</th>
      <th>PRODUCT_ID</th>
      <th>TITLE</th>
      <th>QUQNTITY</th>
      <th>PRICE</th>
      <th>ADDRESS</th>
      <th>STATE</th>
      <th>COUNTRY</th>
      <th>PINCODE</th>
      <th>PURCHASE  DATE</th>
      <th>CUSTOMER NAME</th>
      <th>USERNAME</th>
      <th>MOBILE</th>
      <th>STATUS</th>
      <th>ACTION</th>
     
      </tr>
      <?php


    $get_data = "SELECT * FROM purchase";
    $response = $db->query($get_data);
    if($response)
    {
      while($data = $response->fetch_assoc())
      {
       echo ' <tr> ';

       echo '<td>';
       echo $data['id'];
       echo '</td>';

       echo '<td>';
       echo $data['product_id'];
       echo '</td>';

       echo '<td>';
       echo $data['title'];
       echo '</td>';

       echo '<td>';
       echo $data['quantity'];
       echo '</td>';

       echo '<td>';
       echo $data['amount'];
       echo '</td>';

       echo '<td>';
       echo $data['adr'];
       echo '</td>';

       echo '<td>';
       echo $data['sta'];
       echo '</td>';

       echo '<td>';
       echo $data['country'];
       echo '</td>';

       echo '<td>';
       echo $data['pin_code'];
       echo '</td>';

       echo '<td>';
       echo $data['purchase_date'];
       echo '</td>';

       echo '<td>';
       echo $data['fullname'];
       echo '</td>';

       echo '<td>';
       echo $data['email'];
       echo '</td>';

       echo '<td>';
       echo $data['mobile'];
       echo '</td>';

       echo '<td>';
       echo $data['statuss'];
       echo '</td>';

       echo '<td>';
       echo '<button class="btn btn-primary dispatch m-1" mobile="'.$data['mobile'].'" order_id="'.$data['product_id'].'"   fullname="'.$data['fullname'].'"  email="'.$data['email'].'"  address="'.$data['adr'].'" quantity="'.$data['quantity'].'"  title="'.$data['title'].'" amount="'.$data['amount'].'">DISPATCH</button>';
       echo '</td>';

       echo ' </tr> ';
        
      }
    }

     ?>
      </table>
      </div>
      </div>
      </div>




       </div>




       <script>

  $(document).ready(function(){
    $(".dispatch").each(function(){
    $(this).click(function(){
      var c_btn = this;
      var order_id = $(this).attr("order_id");
      var email = $(this).attr("email");
      var amount = $(this).attr("amount");
      var title = $(this).attr("title");
      var fullname = $(this).attr("fullname");
      var adr = $(this).attr("address");
      var mobile = $(this).attr("mobile");
      var quantity = $(this).attr("quantity");

      $.ajax({
        type : "POST",
        url  : "php/dispatch.php",
        data : {
          id  : order_id,
          email : email,
          amount : amount,
          title : title,
          fullname : fullname,
          adr : adr,
          mobile : mobile,
          quantity : quantity
        },
        beforeSend : function(){
     $(c_btn).html("Wait...");
        },
        success : function(response){
          $(c_btn).html("ORDER DISPATCHED");
         alert(response);
        }
      });
      
    });
    });
  });


  //dispatch all

  $(document).ready(function(){
    $(".d-all").click(function(){
      $(this).html("Wait...");
      var i;
      var btn = $(".dispatch");
      for(i=0;i<btn.length;i++)
      {
        btn[i].click();
      }
    });
  });

       </script>
</body>
</html>