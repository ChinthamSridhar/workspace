<html>
    <head>
        <title>php and database Interaction </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <form action="displaybutton.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
include 'config.php';
if($_POST['movie'] != 'select' && $_POST['thdrop'] != 'select'){
$mdropdown = $_POST['movie'];
$tdropdown = $_POST['thdrop'];
$from = $_POST['date'];
$to = $_POST['date1'];

        $query = "insert into movie_in_theatre(theatre_id,movie_id,from_date,to_date) values('$tdropdown','$mdropdown','$from','$to')";
        $result = mysqli_query($conn,$query);
        if($result){
        $_SESSION['theatre-id'] = $tdropdown;
        echo "inserted successfully";
        }else{
            echo "no record found";
        }
    
}
else
{
    echo "<center><h4>please fill the details</h4></center>";
}
?>



