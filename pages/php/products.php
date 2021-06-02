


<?php
require_once("../../common_file/databases/database.php");
$category_name = $_GET['cat_name'];

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

<script src='../js/index.js'></script>
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
  include_once('../../assets/nav.php');
?>


<div class="container-fluid">
<br>
<a class='p-2 my-2' href="#"><?php echo $category_name;  ?></a>
<div class="row mt-4 ">
<div class="col-md-3">
<div class="bg-white w-100 p-4 border mt-2">
<h5>Filter by brands</h5>
<div class="btn-group-vertical mb-4">
<?php

$get_brands = "SELECT * FROM brands WHERE category_name='$category_name'";
$response = $db->query($get_brands);
if($response)
{
    echo "<button cat-name='".$category_name."' brand-name='all' class=' text-left filter-btn btn px-0'><i class='fa fa-angle-double-right'></i> All</button>";
    while($data =  $response->fetch_assoc())
    {
      $brands =   $data['brands_name'];
      echo "<button cat-name='".$category_name."' brand-name='".$brands."' class=' text-left filter-btn btn px-0'><i class='fa fa-angle-double-right'></i>  ".$brands."</button>";
    }
}

?>
</div>
<h5>Filter by price</h5>
<div class="btn-group-vertical border bg-light shadow-sm mb-4">
<button class="btn">
<input type="number" placeholder="Minimun price" class="form-control min-price">
</button>
<button class="btn mt-2">
<input type="number" placeholder="Maximum price" class="form-control max-price">
</button>
<button class="btn btn-primary price-filter-btn" cat-name="<?php echo $category_name;  ?>">Get products</button>
</div>

<h5>Sort by</h5>
<select class="form-control sort-by">
<option value='Recommended'>recommended</option>
<option value='high'>High to low</option>
<option value='low'>Low to high</option>
<option value='new'>Newest</option>
</select>




</div>
</div>
<div class="col-md-9 p-2">
<div class="bg-white w-100 p-4 border product-result d-flex flex-wrap">
</div>
</div>
</div>
</div>

<?php
  include_once('../../assets/footer.php');
?>

  </body>
</html>