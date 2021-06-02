<?php
require_once("../../common_file/php/database.php");

//previous
$previous_category_name = $_POST['previous_category_name'];
$previous_brand_name = $_POST['previous_brand_name'];


//changed name
$current_category_name = $_POST['current_category_name'];
$current_brand_name = $_POST['current_brand_name'];

$edit_brand = "UPDATE brands SET category_name='$current_category_name',brands_name='$current_brand_name' WHERE category_name='$previous_category_name' AND brands_name='$previous_brand_name'";
$response = $db->query($edit_brand);
if($response)
{
    echo "edit success";
}
else
{
    echo "failed to edit";
}

?>