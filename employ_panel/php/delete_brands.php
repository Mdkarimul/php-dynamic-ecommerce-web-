<?php
require_once("../../common_file/php/database.php");
$category_name = $_POST['category_name'];
$brands_name = $_POST['brands_name'];

$delete_row = "DELETE FROM brands WHERE category_name='$category_name' AND brands_name='$brands_name'";
$response = $db->query($delete_row);

if($response)
{
    echo "Delete success";
}
else
{
    echo "Delete failed";
}


?>