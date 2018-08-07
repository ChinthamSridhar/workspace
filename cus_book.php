<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
if(($_POST['nseats']) != null)
{
    $seats = $_POST['nseats'];
    $query = "insert into booking(movie_in_theatre_id,user_id,no_of_seats,booking_status) values($_SESSION[mit_id],$_SESSION[user_id],$seats,'confirmed')";
    //print_r($query);
    $result =mysqli_query($conn,$query);
    if($result)
    {
        echo "You have booked"." ".$seats."seats<br>";
?>
        <form action="bookinghistory.php" method="post">
            <input type="submit" value="Booking History">
        </form>
    <?php    
    }
}
else
{
    echo "no seats entered";
}
?>
<html>
    <form method="post" action="logout.php" align="right">
        <input type="submit" value="Logout">
    </form>
</html>
