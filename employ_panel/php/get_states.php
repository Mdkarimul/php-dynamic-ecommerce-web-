<?php


require_once("../../common_file/databases/database.php");

$id = $_POST['c_id'];
$states = [];
$get_state = "SELECT * FROM states WHERE country_id='$id'";
$response = $db->query($get_state);
if($response)
{
    while($data = $response->fetch_assoc())
    {
        array_push($states,$data);
    }
   echo json_encode($states);
}

?>