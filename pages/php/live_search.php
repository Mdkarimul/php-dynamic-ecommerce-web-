<?php

require_once("../../common_file/databases/database.php");

$key  = $_POST['key'];

$get_product = "SELECT * FROM products WHERE title LIKE '%$key%' LIMIT 10";
$response = $db->query($get_product);
if($response)
{
    while($data = $response->fetch_assoc())
    {
        echo "<p class='p_tag px-2' p_id='".$data['id']."'>".$data['title']."</p>";
    }

}

?>