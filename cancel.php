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
    <form action="bookinghistory.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
$values = parse_url($_SERVER['REQUEST_URI']);
include 'config.php';

$query ="select booking_status,no_of_seats from booking where id=".$values['query']. " and booking_status='canceled'";
$result = mysqli_query($conn,$query);
$record = mysqli_fetch_assoc($result);
if($record['booking_status'] == 'canceled'){
    echo 'already canceled';
}
else{
$query = "update booking SET booking_status='canceled' WHERE id=".$values['query']; 
//print_r($query);die;
$result = mysqli_query($conn,$query);
if($result)
{
    
    $query = "select ts.available_seats,ts.no_of_seats,b.no_of_seats from theatre_seats ts INNER JOIN booking b ON ts.section_id=b.section_id INNER JOIN movie_in_theatre mit ON mit.id = b.movie_in_theatre_id and mit.theatre_id = ts.theatre_id WHERE b.id=".$values['query'];
    $result = mysqli_query($conn,$query);   
    $record = mysqli_fetch_array($result);

    $nseats = $record[2];
    $query = "update theatre_seats ts INNER JOIN booking b ON b.movie_in_theatre_id = ts.theatre_id and ts.section_id = b.section_id SET ts.available_seats = ts.available_seats + " . $nseats." WHERE b.id=".$values['query'];
    $result = mysqli_query($conn,$query);
    echo "update";
    echo "canceled successfully";
}
}
?>

