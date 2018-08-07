<?php
session_start();
if(isset($_SESSION['user_id']))
     {
        if ($_SESSION['role_id'] == 1)
        {
            header('location:customer.php');
        }
        else if($_SESSION['role_id'] == 3)
        {
            header('location:admin.php');
        }
    } 
else{
        header('location:login.php');
    }
?>
<center>
    <h3 style="color:black">This is vendor section</h3>
</center><br><br>
<form action="logout.php" method="post" align="right">&emsp;&emsp;
    <input type="submit" class="btn btn-info btn-sm" value="Logout">
</form>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    </head>
    <body style=background-color:lightgray>
        <div class="row" align="center">
            <div class="col-sm-1">
                <form action="theatre.php" method="post">
                    <input type="submit" class="btn btn-success btn-sm" value="Add Theatre">
                </form>
            </div>
            <div class="col-sm-1">    
                <form action="movie.php" method="post">
                   <input type="submit" class="btn btn-danger btn-sm" value="Add Movie">
                </form> 
            </div>
            <div class="col-sm-1">
                <form action="displaybutton.php" method="post">
                   <input type="submit" class="btn btn-primary btn-sm" value="MovieInTheatre">
                </form>
            </div>
            <div class="col-sm-1">
                <form action="logdata.php" method="post">
                   <input type="submit" class="btn btn-warning btn-sm" value="GetLogData">
                </form>
            </div>
        </div>   
    </body>
</html>