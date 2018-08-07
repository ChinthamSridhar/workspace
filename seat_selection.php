<html>
<head>
<title>php and database Interaction </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

<body>
    <form action="maindup.php" method="post">
         <input  type="submit" class= "btn btn-warning btn-md" value="BACK">
    </form>

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
$theatre_id = $_GET['theatre_id'];
$mit = $_GET['movie_id'];
$_SESSION['mit_id'] = $mit;
include 'config.php';
    
$query = "select th.name,m.name from theatre th INNER JOIN movie_in_theatre mit ON mit.theatre_id =".$theatre_id." and th.id = ".$theatre_id." INNER JOIN movie m ON mit.movie_id = m.id WHERE mit.id=".$mit;
$result = mysqli_query($conn,$query);

$record = mysqli_fetch_array($result);
echo "<center><h3 style='color:FF3396'>You have selected ".$record[1]." Movie in ".$record[0]." theatre.</h3></center>";    

$query = "select s.id,s.name from seat_sections s INNER JOIN theatre_seats ts ON ts.section_id = s.id  INNER JOIN theatre t ON t.id = ts.theatre_id WHERE ts.theatre_id=".$_GET['theatre_id'];
$result = mysqli_query($conn,$query);    
?>
<html>
    <body background="" >
        <div align="right">
            <form action="logout.php" method="get">
                <input type="submit" value="logout">
            </form>
        </div>
    </body>
</html>

<html>
   <head>
       <style>
           <body >
            .two-col {
            overflow: hidden;/* Makes this div contain its floats */
            }

            .two-col .col1,
            .two-col .col2 {
            width 49%;
                    }

            .two-col .col1 {
            float: left;
            }

            .two-col .col2 {
            float: right;
            }

            .two-col label {
            display: block;
            }
            
       </style>
   </head>
   
<?php 
$query1 = "select s.name,ts.* from seat_sections s INNER JOIN theatre_seats ts ON ts.section_id = s.id  INNER JOIN theatre t ON t.id = ts.theatre_id WHERE ts.theatre_id=".$_GET['theatre_id'];
$result1 = mysqli_query($conn,$query1);
if(mysqli_num_rows($result1)){
    ?>
    <body>
<table align="center">
    <tr>
        <td>
            <h1 align="center" style="color:blue;" >SEATS SELECTION</h1>
            <form align="center" action="seat-validation.php?" method="post">
            <div class="two-col">
                <div class="col1">
                    <label for="field1">No of seats?</label>
                    <input type="text" placeholder="Enter seats.." name="nseats" value=""><br>
                    <input type="hidden" name="id" value="<?php echo $values['query'];?>"> <br> 
                </div>
                <div class="col1">
                    <label for="field1">Section&emsp;&emsp;</label>
                    <select name="name" >
                        <option disabled selected="selected">select</option>
                            <?php 
                            while ($row = mysqli_fetch_array($result))
                            {
                            ?>
                                <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?></option>
                                <?php
                                }
                                ?>
                    </select>
                </div>
            </div>
            <br><br><br><br>
                <input type="submit" value="BOOK NOW">
            </form>
            </td>
        
<table>
    <tr>
        <th>sectionName</th>
        <th>No-of-seats</th> 
        <th>Available-seats</th>
    </tr><br>
<?php
while($record1 = mysqli_fetch_array($result1))
{
    $_SESSION['theatre_id'] =  $record1['theatre_id'];
?>
    <tr>
        <td><?php echo $record1['name'];?></td>
        <td><?php echo $record1['no_of_seats'];?></td> 
        <td><?php echo $record1['available_seats'];?></td>
    </tr>
<?php
}?>
<?php    
    //include 'sstruct.php';
}
    else{
    echo "<center><h4>No Seats Available Yet...<br>Seats will be Added Soon....</h4></center>";
}
    
?>
