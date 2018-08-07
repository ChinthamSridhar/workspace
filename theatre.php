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
        <input  type="submit" class= "btn btn-warning btn-md" value="BACK">
    </form>
    
<?php
session_start();
include('config.php');  
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
    ?>
     <form action="seatsectiondetails.php" method="post" align="right">
        <input  type="submit" class= "btn btn-warning btn-md" value="Add Seats">
    </form>
 <html>
    <body>
        <center>
            <h3>Add Theatre</h3>
        <form action="addtheatredata.php" method="POST" enctype="multipart/form-data">
            Theatre Name&emsp;<input type="text" name="name" required><br><br>
            Address&emsp;&emsp;&emsp;&emsp;<input type="text" name="address" required><br><br>
            No.of Seats&emsp;&emsp;<input type="text" name="nseats" required><br><br><br>
            <input type="file" name="image[]" value="upload" required multiple><br>
            <input type="submit" value="submit">
        </form>
        </center>
        <?php
        $sql="select t.id,t.name,t.address,t.image,t.no_of_seats from theatre t where t.user_id='".$_SESSION['user_id']."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
        ?>
        <center><h4>Theatres List</h4></center>    
        <table class="table">
            <tr>
                <th>NAME</th>
                <th>IMAGE</th>
                <th>address</th>
                <th>no_of_seats</th>
            </tr>
            <?php
            
            while($row = mysqli_fetch_assoc($result))
            { 
                $val = explode(",",$row['image']);
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php foreach($val as $res)
                            {
                                echo "<img height=100 width=200 src='uploads/".$res."' />";
                            } 
                    ?>         
                </td>
                <td><?php echo $row['address']; ?> </td>
                <td><?php echo $row['no_of_seats']; ?> </td>
            </tr><br><br>

            <?php
            }
        }else{
            echo "<center><h4>No Theatres Added</h4></center>";
        }
            ?>
        </table>
     </body>
</html>

     