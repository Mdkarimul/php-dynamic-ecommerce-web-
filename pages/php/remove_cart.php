<?php

require_once("../../common_file/databases/database.php");
$id = $_POST['id'];
$username  = base64_decode($_COOKIE['authentication']);



$delete = "DELETE FROM cart WHERE product_id='$id' AND username='$username'";
$response = $db->query($delete);
print_r($response);
if($response)
{
    echo "success";

}
else
{
    echo "failed to delete !";


}


?>