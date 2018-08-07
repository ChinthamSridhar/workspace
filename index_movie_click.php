

<?php
session_start();
$values = parse_url($_SERVER['REQUEST_URI']);
include 'config.php';
if(isset($_SESSION['login_attemp']) == 1){
?>
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
    <form action="maindup.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
    <div align="right">
     <form action="logout.php" method="post">
        <input type="submit" value="LOGOUT">
     </form>
</div>
    <?
$sql = "select t.id,t.name,t.address,t.image,t.no_of_seats,mt.from_date,mt.to_date,mt.id from theatre t left join movie_in_theatre mt on t.id=mt.theatre_id where mt.movie_id=".$values['query'];
//print_r($sql);die;
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) == NULL){
    echo "<center><h4>Movie Not Added in Theatre</h4></center>";
}
else{
?>
<center>Movie in Theatre</center>
<div class="container">
<table cellpadding="5" class="table">
   <thead>
       <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>ADDRESS</th>
            <th>IMAGE</th>
            <th>No_of_Seats</th>
            <th>FROM_DATE</th>
            <th>TO_DATE</th>
       </tr>
   </thead>

   <tbody>
<?php
    while ($row = mysqli_fetch_array($result))
    {
        
        $image=$row['image'];
        $host=explode(',',$image);
        $mit = $row[7];
        $theatre_id = $row[0];
        //print_r($mit);die;

?>
    <tr>
        <td><?php echo $row[0]; ?> </td>
        <td>
            <?php echo "<h4>Book here</h4>";
                  echo " <a href='seat_selection.php?theatre_id=$theatre_id&movie_id=$mit'>" .$row['name']."</a>";
            ?>
        </td>
        <td><?php echo $row['address']; ?></td>
        <td>
            <?php foreach($host as $val)
                {
                    echo "<a href='seat_selection.php?theatre_id=$theatre_id&movie_id=$mit'>".'<img width=100 height=100 src="uploads/'.$val.'"/>'."</a>"; 
                }
            ?>    
        </td>
        <td><?php echo $row['no_of_seats'];?></td>
        <td><?php echo $row['from_date']; ?></td>
        <td><?php echo $row['to_date']; ?></td>
    </tr>
    <br>
    <?php
    }
?>

    </tbody>        
</table>
    </div>
<?php
}
}
else
{
    ?>
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
    <form action="main.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
    <?php
$sql="select t.id,t.name,t.address,t.image,t.no_of_seats,mt.from_date,mt.to_date,mt.id from theatre t left join movie_in_theatre mt on t.id=mt.theatre_id where mt.movie_id=".$values['query'];
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
//print_r($query); die;
?>
   <table cellpadding=5 class="table">
<tr>
    <th>ID</th>
    <th>TheatreName</th>
    <th>Address</th>
    <th>Image</th>
    <th>No_of_seats</th>
    <th>from_date</th>
    <th>to_date</th>
   
</tr><br>
<?php
  while($record = mysqli_fetch_array($result))
  {
      $image=$record['image'];
      $host=explode(',',$image);
      $_SESSION['mit_id'] = $record['id'];
?>
    <tr>
        <td><?php echo $record[0];?></td>
        <td><a href="login.php"><?php echo $record[1];?></a></td>
        <td><?php echo $record['address']; ?></td>
        <td>
            <?php foreach($host as $val)
                {
                echo '<a href="login.php"><img height=150 width=200 src="uploads/'.$val.'" /></a>';
                }
            ?>    
        </td>
        <td><?php echo $record['no_of_seats'];?></td>
        <td><?php echo $record['from_date'];?></td>
        <td><?php echo $record['to_date'];?></td>
    </tr>
    
    <?php
  }

}else{
    echo "<center><h4>Movie Not Added in Theatre</h4></center>";
}
}
?>
    
</table>
