<?php
require_once("../../common_file/php/database.php");
$id =  $_POST['id'];
$name = $_POST['changed_name'];

$update = "UPDATE category SET category_name='$name' WHERE id='$id'";
if($db->query($update))
{
    echo "update success";
}
else
{
    echo "Update failed !";
}



?>