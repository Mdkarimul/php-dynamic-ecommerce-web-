<?php  
require_once("../../common_file/databases/database.php");
$rateing  = $_POST['rating'];
$p_id = $_POST['p_id'];
$comment = $_POST['comment'];
$picture = $_FILES['picture'];
$file = addslashes(file_get_contents($picture['tmp_name']));

$username = base64_decode($_COOKIE['authentication']);

$update  = "UPDATE purchase SET rating='$rateing',comment='$comment',picture='$file' WHERE email='$username' AND product_id='$p_id'";
$response = $db->query($update);
if($response)
{
    echo "success";
}
else
{
    echo "failed to update";
}





?>