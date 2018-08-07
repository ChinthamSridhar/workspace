<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
$id= $_GET ['id'];
if($id)
    {
        $sql="select name,address,no_of_seats from theatre where id=$id";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
    ?>
        <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['no_of_seats'];?></td>
<?php
}
else
{
    header('location:login.php');
}
?>
<form action="theatre.php" method="get">
    <input type="submit" value="BACK">
</form>
    