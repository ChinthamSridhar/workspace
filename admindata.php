<html>
<head>
<title>php and database Interaction </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

<body style="">
    <form action="admin.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
if(isset($_SESSION['user_id'])){
        if($_SESSION['role_id'] == 2){
            header('location:vendor.php');
        } else if ($_SESSION['role_id'] == 1){
            header('location:maindup.php');
        }  
}
else{
    header('location:main.php');
}
include 'config.php';
$sql = "update movie SET selected = 'NO'";
$result = mysqli_query($conn,$sql);
if(empty($_POST['checkgrp']))
{
        $sql = "update movie SET selected = 'NO' ";
        $result = mysqli_query($conn,$sql);
        echo "<center><h4>No checkbox selected.</h4><center>";   
}
else{
    $checkgrp = array();
    $checkgrp = $_POST['checkgrp'];
    if($checkgrp){
        foreach($checkgrp as $value)
        {
            $sql = "update movie SET selected='YES' where id='".$value."' ";
            $result = mysqli_query($conn,$sql);
            
            
        }
        echo "<center><h4>Image successfully Added to Main Page </center></h4>";
    }
}
?>

