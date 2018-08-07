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
        <form action="maindup.php" method="post">
            <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
        </form>

<?php
session_start();
include 'config.php';
if(isset($_SESSION['user_id'])){
    if ($_SESSION['role_id'] == 2){
         header('location:customer.php');
    }
} 
else {
    header('location:login.php');
}
if($_POST['nseats']){
    $seats = $_POST['nseats'];
    $id = $_POST['name'];
    $_SESSION['section_id'] = $id;
    //print_r($id);die;
    $query = "select available_seats from theatre_seats where theatre_id = ".$_SESSION['theatre_id']." and section_id=".$id;
    //print_r($query);die;
    $result = mysqli_query($conn,$query);
    $record = mysqli_fetch_assoc($result);
    $value = $record['available_seats'];
    
    if($seats <= $value){
        $query = "insert into booking(movie_in_theatre_id,user_id,no_of_seats,booking_status,section_id)                            values($_SESSION[mit_id],$_SESSION[user_id],$seats,'confirmed',$id)";
        $result = mysqli_query($conn,$query);
        echo "seats".$seats."<br>booking confirmed";
        $query2 = "update theatre_seats SET available_seats = available_seats - $seats WHERE section_id=".$id." and                                            theatre_id=".$_SESSION['theatre_id'];
        $result = mysqli_query($conn,$query2);
        echo "<br>update success";
    }
    else{
        echo "Available Seats &emsp;".$record['available_seats'];
    }
}
else
{
    echo "please Enter seats";
}
?>
 