
<html>
    <head>
        <title> Online Movie ticket booking</title>
    </head> 
    <body>
        
        <h1 align="center" style="color:rgb(150,128,0)">MOVIE TICKET BOOKING</h1>          
        <form align="left" action="search_movie.php" method="post">
            <div align="center">
                <input type="search" name="search" placeholder="Search Movie" size="40">
                <input type="submit" value="submit">
            </div>
            <div align="right">
                <h2 style="color:orange;">
                <a href="login.php">Login</a>
                </h2>
            </div>    
            <div align="right">
            <h2>
                <a href="register.php" >Sign up</a>
            </h2>
        </div>
        </form>     
    </body>
</html>
<?php
    include('index_movie_display.php');
?>
