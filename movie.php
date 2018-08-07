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
    <form action="vendor.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
include 'config.php';
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
?>
<html>
    <body><center><h4>Add Movie</h4>
        <form action ="addmovie.php" method="post" enctype="multipart/form-data">
            MovieName:<input type="text" name="name" required><br><br>
            <input type="file" name="image[]" value="upload"  required multiple><br>
            &emsp;&emsp;<input type="submit" value="submit"> 
        </form>
        </center>
    </body>
</html>   
    
<?php
    $query = "select m.name,m.image from movie m where m.user_id=".$_SESSION['user_id']." group by m.name";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)){?>
        <h3><center>Added Movies</center></h3>
    <table class="table">
        <tr>
            <td>Movie Name</td>
            <td>Image</td>
        </tr>
    <?php
    while($record = mysqli_fetch_assoc($result)){
         $val = explode(",",$record['image']);
        ?>
         <tr>
         <td><?php echo $record['name'];?></td>
         <td><?php foreach($val as $res)
                        {
                            echo "<img height=100 width=200 src='uploads/".$res."' />";
                        } 
             ?>         
        </td>
    <?php  
    }
    ?>
    </table>
    <?php
    }
    else{
        echo "<center><h4>No Movies Added</h4></center>";
    }
    ?>
   