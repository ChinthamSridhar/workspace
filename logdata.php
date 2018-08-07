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
$query = "select * from log_user where user_id='".$_SESSION['user_id']."'";
$result = mysqli_query($conn,$query);
?>
<table cellpadding=4>
    <tr>
        <th>IP</th>
        <th>STATUS</th>
        <th>LOGIN TIME</th>
        <th>LOGOUT TIME</th>
    </tr>
    <?php
    while($record = mysqli_fetch_assoc($result))
    {
    ?>
        <tr>
            <td><?php echo $record['ip'];?></td>  
            <td><?php echo $record['status'];?></td>
            <td><?php echo $record['login_time'];?></td>
            <td><?php echo $record['logout_time'];?></td>
        </tr>
    <?php
    }
    ?>