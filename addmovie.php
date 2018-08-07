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
    <form action="movie.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
include 'config.php';
if($_SESSION == NULL)
{
    header('location:login.php');
}
   // echo "<pre>";print_r($_FILES);die;

    $name = $_POST['name'];
    $uploads_dir = 'uploads/';
    $images_arr = array();
foreach($_FILES['image']['name'] as $key => $value)
{
    $images[] = $value;
    $target = "uploads/".basename($_FILES['image']['name'][$key]);
    $result = move_uploaded_file($_FILES['image']['tmp_name'][$key], $target);
}
$finalval = implode(',',$images);
    if($name != NULL && $finalval != '')
{
    $query = "insert into movie(user_id,name,image,selected) values ($_SESSION[user_id],'$name','$finalval','NO')";
    $result = mysqli_query($conn,$query);
    echo "<center><h4 style='color:green'>Movie added successfully</h4><center>";
}
else{
        echo "<center><h4>Please Enter Movie name and Upload Image </h4></center>";
    }
?>



