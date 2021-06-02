<?php


require_once("../../common_file/databases/database.php");

$id = $_POST['s_id'];
$cities = [];
$get_city = "SELECT * FROM cities WHERE state_id='$id'";
$response = $db->query($get_city);
if($response)
{
    while($data = $response->fetch_assoc())
    {
        array_push($cities,$data);
    }
   echo json_encode($cities);
}

?>