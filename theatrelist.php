<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
$query = "select * from theatre";
$result = mysqli_query($conn,$query);
?>
<html>
    <body>
        <table cellpadding=2>
            <tr>
                <th>Theatre Name</th>
                <th>Address</th>
                <th>No.of.Seats</th>
                <th>Image</th>
            </tr>
    
        <?php
        while($row = mysqli_fetch_assoc($result))
        { 
            $val = explode(",",$row['image']);
        ?>
            <tr>
                <td><?php echo $row['name'] ;?> </td>
                <td><?php foreach($val as $res)
                            {
                                echo "<img src='uploads/".$res."' />";
                            } 
                    ?>
                </td>
                <td><?php echo $row['address']; ?> </td>
                <td><?php echo $row['no_of_seats'];?> </td>
            </tr>
        <?php
        }
        ?>
        </table>
    </body>
</html>
