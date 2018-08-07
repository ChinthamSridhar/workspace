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
    <form action="theatre.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>

<?php
session_start();
if($_SESSION == NULL)
{
    header('location:main.php');
}
include 'config.php';
 
$uploads_dir = 'uploads/';
//echo "<pre>"; print_r($_FILES);
$images_arr = array();
foreach($_FILES['image']['name'] as $key => $value)
{
    $images[] = $value;
    $target = "uploads/".basename($_FILES['image']['name'][$key]);
    $result = move_uploaded_file($_FILES['image']['tmp_name'][$key], $target);
}
$finalval = implode(',',$images);
if($_POST['name'] != NULL && $_POST['address'] != NULL && $_POST['nseats'] != NULL && $finalval != NULL)
{   
$query = "insert into theatre (user_id,name,address,no_of_seats,image) values($_SESSION[user_id],'$_POST[name]','$_POST[address]',$_POST[nseats],'$finalval')";
$result = mysqli_query($conn,$query);
if($result)
{     
    
    echo "<center><h4>theatre added successfully</h4></center> ";
    //header('location:theatredetails.php');
}
}else{
    echo "<center><h4>please fill all fields</h4></center>";
}
?>