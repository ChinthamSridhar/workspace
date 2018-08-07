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
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
$query = "select t.id,t.name from theatre t where t.user_id=".$_SESSION['user_id'];
$result = mysqli_query($conn,$query);
?>
<html>
    <body><center><h4>Add Movie In Theatre</h4>
        <form action="theatremoviedetails.php" method="post">
            Theatre <select  required name = "thdrop">
                        <option>select</option>
                        <?php 
                        while($row=mysqli_fetch_assoc($result))
                        {
                        ?>
                            <option value="<?php  echo $row['id'] ?>"> <?php  echo $row['name'] ;?> </option>
                        <?php
                        }
                        ?> 
                    </select><br><br>
            <?php
            $query = "select m.id,m.name from movie m WHERE m.user_id=".$_SESSION['user_id'];
            $result = mysqli_query($conn,$query);
            ?>
            Movie&emsp;&emsp;&emsp;&emsp;<select name ="movie" required>
                    <option>select</option>
                    <?php 
                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                        <option value = "<?php  echo $row['id'] ?>"> <?php  echo $row['name'] ;?> </option>
                    <?php
                    }
                    ?> 
                </select><br><br>
            From Date <input type="datetime-local" name="date"  date-date-inline-picker="true" required><br><br>
            To Date   <input type="datetime-local" name="date1" date-date-inline-picker="true" required>
            <br><br>
            &emsp;&emsp;<input type="submit" value="submit">
        </form>
        </center>
    <?php
    $query = "select t.name,m.name,mit.* from movie m INNER JOIN movie_in_theatre mit ON mit.movie_id = m.id INNER JOIN theatre t ON t.id = mit.theatre_id WHERE t.user_id=".$_SESSION['user_id'];
    //print_r($query);die;
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)){
    ?>
    <table cellpadding=5 class="table">
        <tr>
            <th>TheatreName</th>
            <th>MovieName</th>
            <th>FromDate</th>
            <th>ToDate</th>
        </tr>
        <?php  
        while($row = mysqli_fetch_array($result))
            {
         ?>
            <tr>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                <td><?php echo $row['from_date'];?></td>
                <td><?php echo $row['to_date'];?></td>
            </tr>
        <?php
            }
    }
        else{
            echo "<center><h4>There is no movie added in theatre</h4></center>";
        }
        ?>
        </table>
    </body>
</html>
