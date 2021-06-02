<?php
require_once("../../common_file/php/database.php");
$id =  $_POST['id'];

$delete = "DELETE FROM category WHERE id='$id'";
if($db->query($delete))
{
    echo "delete success";
}
else
{
    echo "failed to delete";
}

?>