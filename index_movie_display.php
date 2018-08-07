<?php
//session_start();
include 'config.php';
$sql="select * from movie WHERE selected = 'YES'";
$result=mysqli_query($conn,$sql);
?>
<html>
    <body align="center">
        <?php
            while($row=mysqli_fetch_array($result))
                {
                //$_SESSION['id'] = $row['id'];
                echo "&emsp; <a href='index_movie_click.php?".$row['id']."'>".'<img height =200 width=250 src="uploads/'.$row['image'].'"/>'."</a>";
                }
        ?>
    </body>
</html>


