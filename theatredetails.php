
<?php
//session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
?>
<!--<h3>Theatre added successfully</h3><br><br>-->
    <form action = "seatsectiondetails.php" method="post" align="right">
        <input type = "submit" value="Add Sections">
    </form>

       
      