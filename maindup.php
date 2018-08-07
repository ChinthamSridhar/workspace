
<?php
session_start();
if(isset($_SESSION['user_id']))
     {
        if ($_SESSION['role_id'] == 2){
            header('location:vendor.php');
        }
    
    } else {
        header('location:login.php');
    }
?>
<html>
    <head>
        <title> Online Movie ticket booking</title>
    </head>
    <body background="">
        <div align="right">
            <h3><br><br>
                <form action="logout.php" method="post">
                    <input type="submit" value="Logout">
                 </form>
            </h3>
        </div>
            <h1 align="center" style="color:rgb(128,0,0)">MOVIE TICKET BOOKING</h1>
                <form align="left" action="search_movie.php" method="post">
                    <div align="center">
                        <input type="search" name="search" placeholder="Search Movie" size="20">
                        <button>Search</button>
                    </div>
                </form>       
    </body>
</html>
<?php
    include('index_movie_display.php');
?>
<br><br>
<a href="bookinghistory.php">Booking History</a>
