<?php

require_once("../../common_file/databases/database.php");
$id = $_POST['id'];

$get_data = "SELECT * FROM header_showcase WHERE id='$id'";

$response = $db->query($get_data);
$data = $response->fetch_assoc();

$image = "data:image/png;base64,".base64_encode($data['title_image']);
$title_text = $data['title_text'];
$title_color = $data['title_color'];
$title_size = $data['title_size'];

$subtitle_text = $data['subtitle_text'];
$subtitle_color = $data['subtitle_color'];
$subtitle_size = $data['subtitle_size'];
$h_align = $data['h_align'];
$v_align = $data['v_align'];
$buttons = $data['buttons'];
$all_data = [$image,$title_text,$title_size,$title_color,$subtitle_text,$subtitle_color,$subtitle_size,$h_align,$v_align,$buttons];


echo json_encode($all_data);
 //print_r($all_data[2]);



?>