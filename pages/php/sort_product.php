<?php

require_once("../../common_file/databases/database.php");
if(empty($_COOKIE['authentication']))
{
    header("Location:../../signup.php");
    exit;
}

$username = base64_decode($_COOKIE['authentication']);

$c_name = $_POST['c_name'];
$b_name = $_POST['b_name'];
$sort_by = $_POST['sort_by'];
$all_data = [];



if($b_name =="all")
{
   


    if($sort_by =="high")
    {
        $get_data = "SELECT * FROM products WHERE category_name='$c_name'  ORDER BY price DESC";
        $response = $db->query($get_data);
        if($response)
        {
            while($data = $response->fetch_assoc())
            {
            array_push($all_data,$data);
            }
           echo  json_encode($all_data);
        }
        
    }
    
    
    
    else if($sort_by =="low")
    {
        $get_data = "SELECT * FROM products WHERE category_name='$c_name'  ORDER BY price ASC";
        $response = $db->query($get_data);
        if($response)
        {
            while($data = $response->fetch_assoc())
            {
            array_push($all_data,$data);
            }
           echo  json_encode($all_data);
        }
        
    }
    
    
    else if($sort_by =="Recommended")
    {
        $get_data = "SELECT * FROM products WHERE category_name='$c_name'  ";
        $response = $db->query($get_data);
        if($response)
        {
            while($data = $response->fetch_assoc())
            {
            array_push($all_data,$data);
            }
           echo  json_encode($all_data);
        }
        
    }
    
    
    else if($sort_by =="new")
    {
        
        $get_data = "SELECT * FROM products WHERE category_name='$c_name'  ORDER BY datee DESC";
        $response = $db->query($get_data);
        if($response)
        {
            while($data = $response->fetch_assoc())
            {
            array_push($all_data,$data);
            }
           echo  json_encode($all_data);
        }
        
    }




}
else
{
    if($sort_by =="high")
{
    $get_data = "SELECT * FROM products WHERE category_name='$c_name' AND brands_name='$b_name' ORDER BY price DESC";
    $response = $db->query($get_data);
    if($response)
    {
        while($data = $response->fetch_assoc())
        {
        array_push($all_data,$data);
        }
       echo  json_encode($all_data);
    }
    
}



else if($sort_by =="low")
{
    $get_data = "SELECT * FROM products WHERE category_name='$c_name' AND brands_name='$b_name' ORDER BY price ASC";
    $response = $db->query($get_data);
    if($response)
    {
        while($data = $response->fetch_assoc())
        {
        array_push($all_data,$data);
        }
       echo  json_encode($all_data);
    }
    
}


else if($sort_by =="Recommended")
{
    $get_data = "SELECT * FROM products WHERE category_name='$c_name' AND brands_name='$b_name' ";
    $response = $db->query($get_data);
    if($response)
    {
        while($data = $response->fetch_assoc())
        {
        array_push($all_data,$data);
        }
       echo  json_encode($all_data);
    }
    
}


else if($sort_by =="new")
{
    
    $get_data = "SELECT * FROM products WHERE category_name='$c_name' AND brands_name='$b_name' ORDER BY datee DESC";
    $response = $db->query($get_data);
    if($response)
    {
        while($data = $response->fetch_assoc())
        {
        array_push($all_data,$data);
        }
       echo  json_encode($all_data);
    }
    
}
}

?>