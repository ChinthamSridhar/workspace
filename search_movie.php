<html>
    <head>
        <title>php and database Interaction </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body style="background-color:rgb(255,99,71,0.5);">
        <form action="main.php" method="post">
            <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
        </form>
<?php
session_start();
include 'config.php';
if(isset($_SESSION['login_attemp']) == 1)
{
    if($_POST['search'] == NULL){
        echo "<center>Please enter Movie name</center>";
    }
    else{
        $query = "select id,name,image from movie where name like '%".$_POST['search']."%'";
        $result = mysqli_query($conn,$query);
    
        if(mysqli_num_rows($result) == 0){
            echo "<center>No Movies Found with &emsp;".$_POST['search']."</center>";
        }
   else{
    ?>
    <table cellpadding = 2 >
        <tr>
            <th>ID</th>
            <th>MovieName</th>
            <th>IMAGE</th>
        </tr><br>
        <?php
        while($record = mysqli_fetch_assoc($result))
        {
            $image = $record['image'];
            $val = explode(",",$image);
            $_SESSION['id'] = $record['id'];
        ?>
        <tr>
            <td><?php echo $record['id'];?> </td>
            <td><a href = "index_movie_click.php?<?php echo $record['id'];?>"><?php echo $record['name'];?></a> </td>
            <td>
                <?php foreach($val as $res)
                            {
                            echo '<img height=150 width=200 src="uploads/'.$res.'" />';
                        }    
                ?> 
            </td>
            <td>
                <form action ="bookmovieindex.php" method="post">
                    <input type="submit" value="Book">
                </form>
            </td>
        </tr> 
        <?php 
        }
   }
} 
}
else {
    if($_POST['search'] == NULL){
        echo "<h4><center>please enter movie name</center></h4>";
    }
    else{
    $search = $_POST['search'];
    $query = "select id,name,image from movie where name like '%".$search."%'";
    //print_r($query);die;
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h4><center>No Movies Found with &emsp;".$search."</center></h4>";
    }
    else{
?>  <div class="container">
        <table cellpadding = 5 class="table">
            <tr>
                <th>ID</th>
                <th>MovieName</th>
                <th>IMAGE</th>
            </tr><br>
        <?php
        while($record = mysqli_fetch_assoc($result))
        {
            $image = $record['image'];
            $val = explode(",",$image);
    ?>
            <tr>
                <td><?php echo $record['id'];?> </td>
                <td><a href = "index_movie_click.php?<?php echo $record['id'];?>"><?php echo $record['name'];?></a> </td>
                <td>
                    <?php foreach($val as $res){
                        echo '<img height=150 width=200 src="uploads/'.$res.'" />';
                    }    
                    ?> 
                </td>
            </tr> 
        <?php
        }
    }
 }
}

?>
</table>
        </div>
    
    