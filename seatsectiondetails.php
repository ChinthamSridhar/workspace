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
    <form action="theatre.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
?>
<html>
    <body>
        <center>
            <h3>Add Seats in each Section</h3>
        <form action="seatsections.php" method="post"><br><br>
            Theatre &emsp;&emsp;&emsp;&emsp;<select name="theatre">
                        <option>select</option>
                        <?php 
                            $sql="select t.id,t.name from theatre t WHERE t.user_id =".$_SESSION['user_id'] ;
                            $result = mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($result))
                            {
                            ?>
                        <option value="<?php  echo $row['id'] ?>"> <?php  echo $row['name'] ;?> </option>
                        <?php
                        }
                        ?> 
                    </select><br><br>
              
            Seat sections&emsp;<select name="dseats">
                                <option>selects</option>
                            <?php  
                            $sql="select id,name from seat_sections";
                            $result=mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            { 
                            ?>
                                <option value="<?php echo $row['id'] ;?>" > <?php echo $row['name'] ?> </option>;
                            <?php
                            }  
                            ?>
                          </select><br><br>

            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;No.of seats&emsp; <input type="text" name="seats"><br><br>
        &emsp;&emsp;<input type="submit" value="submit">
        </form>
        </center>
    </body>
</html>
        
