<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
    </head>
    <form action = "maindup.php" method="post">
    <input type="submit" value="HOME" class="btn btn-success">
    </form>
<?php
 session_start();
        if(isset($_SESSION['username'])&& $_SESSION['password'] || $_SESSION['user_id'])
     {
        if ($_SESSION['role_id'] == 1)
        {
            header('location:maindup.php');
        }
        else if($_SESSION['role_id'] == 2){
            header('location:vendor.php');
        }
            else {
                //
            }
    } 
else{
        header('location:login.php');
    }
?>
<form action="logout.php" method="post" align="right">
    <input type="submit" class="btn btn-danger" value="logout">
</form>
<?php
 echo '<center><h3 style="color:rgb(0,0,255,0.5)">This is admin section</h3></center><br>';
 include 'config.php';
 $conn = mysqli_connect($server , $user , $password , $database);
 $query = "select id,name,selected from movie";
 $result = mysqli_query($conn,$query);
?>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
    </head><center><br><br><br>
    <p style="color:red">WELCOME TO ADMIN PAGE</p>
    <form action="admindata.php" method="post">
    <table cellpadding=5>
        <?php
        while($record = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td>
                <input type="checkbox" name="checkgrp[]" value="<?php echo $record['id'];?>" <?php if($record['selected'] == 'YES'){ echo 'checked'; }?> > <?php echo $record['name'];?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table><br>
        <input type="submit" class = "btn btn-info" value="upload" name="submit">
    </form>
</center>

<?php
$query = "select * from movie WHERE selected='YES'";
$result = mysqli_query($conn,$query);
?>
<center><h3>Movies List</h3></center>
<table cellpadding=5 class="table">
    <tr>
        <th>Name</th>
        <th>Image</th>
    </tr>
<?php
while($record = mysqli_fetch_assoc($result))
{ 
     $val = explode(",",$record['image']);
?>
    <tr>
        <td><?php echo $record['name'];?></td>
        <td><?php foreach($val as $res)
                        {
                             echo "<img height=50 width=100 src='uploads/".$res."' />";
                        } 
            ?>         
        </td>
    </tr>
    <?php
}
    ?>
    </table>