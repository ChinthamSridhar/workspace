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
<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:main.php');
    }
include 'config.php';
?>

<?php
    ?>
    <b>Booking History</b>
<?php
    $perpage = 1;
    if(isset($_GET['pagenum']) && !empty($_GET['pagenum'])){
        $curpage = $_GET['pagenum'];
    }
    else{
        $curpage = 1;
    }
    $start = ($curpage * $perpage) - $perpage;
    $query = "select th.name,m.name,bs.* from movie m INNER JOIN movie_in_theatre mit ON mit.movie_id=m.id INNER JOIN theatre th ON th.id=mit.theatre_id INNER JOIN booking bs ON bs.movie_in_theatre_id=mit.id WHERE bs.user_id=".$_SESSION['user_id']." order by bs.id DESC";
    //print_r($query);die;
    $result = mysqli_query($conn,$query);
    $total_rows = mysqli_num_rows($result);
    
    $endpage = ceil($total_rows / $perpage);
    $startpage = 1;
    $nextpage = $curpage + 1;
    $previouspage = $curpage - 1;
    
    $sql = $query = "select th.name,m.name,bs.* from movie m INNER JOIN movie_in_theatre mit ON mit.movie_id=m.id INNER JOIN theatre th ON th.id=mit.theatre_id INNER JOIN booking bs ON bs.movie_in_theatre_id=mit.id WHERE bs.user_id=".$_SESSION['user_id']." order by bs.id DESC LIMIT $start, $perpage";
    $result1 = mysqli_query($conn,$sql);
    
    if($result1)
    {
    ?>
        <table cellpadding=5 class="table">
            <tr>
                <th>booking id</th>
                <th>TheatreName</th>
                <th>Movie</th>
                <th>seats</th>
                <th>status</th>
             </tr>
            <?php
            while($record = mysqli_fetch_array($result1)){
            ?>
                <tr>
                    <td><?php echo $record['id'];?></td>
                    <td><?php echo $record[0];?></td>
                    <td><?php echo $record[1];?></td>
                    <td><?php echo $record['no_of_seats'];?> </td>
                    <td><?php echo $record['booking_status'];?> </td>
                    <td><form method="post" action="cancel.php?<?php echo $record['id'];?>">
                            <input type="submit" value="cancel">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <center>
    
    <ul class="pagination">
        <?php if($curpage != $startpage){?>
             <li class="page-item">   
               <a class="page-link" href="?pagenum=<?php echo $curpage - $startpage;?>" aria-label="Previous"> 
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">First</span>
               </a>
               </li>
          <?php  } ?>
   
    <?php if($curpage >= 2){
            if($curpage == $endpage){?>
        <li class="page-item "><a class="page-link" href="?pagenum=<?php echo $previouspage-1; ?>"><?php echo $previouspage-1;?></a></li>
              <li><a class="page-link" href="?pagenum=<?php echo $previouspage; ?>"><?php echo $previouspage;?></a></li>
              
               <?php   } else {?>
              <li><a class="page-link" href="?pagenum=<?php echo $previouspage; ?>"><?php echo $previouspage;?></a></li>
        <?php } }?>
        <?php 
            if($curpage != $endpage){?>
            <li class="active"><a class="page-link" href="?pagenum=<?php echo $curpage; ?>"><?php echo $curpage;?></a></li>
            <li><a class="page-link" href="?pagenum=<?php echo $nextpage; ?>"><?php echo $nextpage;?></a></li>
            <li class="page-item">
            <a class="page-link" href="?pagenum=<?php echo $curpage + 1 ;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Last</span>
            </a>
            </li>
        <?php } ?>
        <?php 
            if($curpage == $endpage){?>
                
                <li class="page-item active"><a class="page-link" href="?pagenum=<?php echo $curpage; ?>"><?php echo $curpage;?></a></li>
           <?php  } ?>
        </ul>
        </center>
        <?php 
        
    }
     
else
    {
        echo "No bookings found";
    }
    ?>