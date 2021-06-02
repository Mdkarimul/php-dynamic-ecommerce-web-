<?php

require_once("../../common_file/php/database.php");

$category_list = [];
$select = "SELECT * FROM category";
$response = $db->query($select);
if($response)
{
while($data = $response->fetch_assoc())
{
    array_push($category_list,$data);
 
}
echo json_encode($category_list);
}
else
{
echo "<b>No category found !</b>";    
}

?>