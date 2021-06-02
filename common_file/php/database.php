<?php
$db = new mysqli("localhost","root","","ecommerce");

if($db->connect_error)
{
    die("failed to connect");
}


?>