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
    <form action="seatsectiondetails.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
if($_POST['dseats'] != 'selects' && $_POST['theatre'] != 'select' && $_POST['seats'] != NULL)
{ 
$dsection = $_POST['dseats'];
$dtheatre = $_POST['theatre'];
$seats = $_POST['seats'];  
$sql1="select no_of_seats from theatre where id = $dtheatre";
//print_r($sql1);die;
$result1=mysqli_query($conn,$sql1);
$row1=$result1->fetch_assoc();
$val1=$row1['no_of_seats'];
$sql = "select sum(no_of_seats) as seats from theatre_seats where theatre_id = $dtheatre group by theatre_id ";
$result2 = mysqli_query($conn,$sql);
$record = mysqli_fetch_assoc($result2);
$sum = $record['seats'];
if($seats != NULL)
{
    if($result2 == NULL)
    {    
         $sql="insert into theatre_seats(section_id,theatre_id,no_of_seats,available_seats) values('$dsection','$dtheatre','$seats','$seats')";
         $result=mysqli_query($conn,$sql);
         echo "success";
    }
    else if($result2 != NULL){
        $sql = "select ts.no_of_seats from theatre_seats ts INNER JOIN theatre t ON ts.theatre_id = t.id WHERE ts.theatre_id = $dtheatre and section_id = $dsection";
        $result = mysqli_query($conn,$sql);
        $record = mysqli_fetch_assoc($result);
        $val = $record['no_of_seats'];
        if($val<$val1){
               $remain = $val1-$val;
              
               if($seats>$remain)
               {
                  echo "<h2>"."ONLY $remain SEATS ARE AVAILABLE TO FILL"."</h2>";
               }
            else{
              $sql="insert into theatre_seats(section_id,theatre_id,no_of_seats,available_seats) values('$dsection','$dtheatre','$seats','$val')";
              $result=mysqli_query($conn,$sql);
              echo "<h2>"."SEATS ADDED SUCCESSFULLY"."</h2>";
               }
        }
            else{
                echo "ALL SECTIONS ARE FILLED";
            }
        }      

else{
     echo "fail";
}
}
else{
     echo "fail";
}
}
    else{
        echo "<center><h4>please enter all details</h4></center>";
    }
?>