<?php
require_once("../../common_file/databases/database.php");
$id =  $_POST['id'];

$delete = "DELETE FROM header_showcase WHERE id='$id'";
$response = $db->query($delete);
if($response)
{
    echo "Delete success";
}
else
{
    echo "Enable to delete title";
}



?>