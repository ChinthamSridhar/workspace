<?php
session_start();
if($_SESSION == NULL)
    {
        header('location:login.php');
    }
include 'config.php';
if(isset($_SESSION['login_attemp']) == 1)
{
    $query = "select th.name,s.name,ts.no_of_seats,mit.theatre_id from theatre th INNER JOIN theatre_seats ts ON th.id = ts.theatre_id INNER JOIN seat_sections s ON s.id = ts.section_id INNER JOIN movie_in_theatre mit ON mit.theatre_id = ts.theatre_id WHERE mit.id=".$_SESSION['mit_id'];
    //print_r($query); die;
    $result = mysqli_query($conn,$query);
    ?>
    <table>
        <tr>
            <th>TheatreName</th>
            <th>sectionName</th>
            <th>No_of_seats</th>
            <th>BOOK HERE</th>
        </tr><br>
        <?php
        while($record = mysqli_fetch_array($result))
        {
        ?>
        <tr>
            <td><?php echo $record[0];?></td>
            <td><?php echo $record[1];?></td>
            <td><?php echo $record['no_of_seats'];?></td>
            <td>
                <form action="bookingdata.php" method="post">
                    Enter seats<input type="text" name="nseats">
                    <input type="submit" value="BOOK">
                </form>
            </td>
        </tr>
<?php
}
?>
    </table>
<?php
}
else 
{
    $query = "select th.name,s.name,ts.no_of_seats,mit.theatre_id from theatre th INNER JOIN theatre_seats ts ON th.id = ts.theatre_id INNER JOIN seat_sections s ON s.id = ts.section_id INNER JOIN movie_in_theatre mit ON mit.theatre_id = ts.theatre_id WHERE mit.id=".$_SESSION['mit_id'];
    //print_r($query); die;
    $result = mysqli_query($conn,$query);
?>
    <table>
        <tr>
            <th>TheatreName</th>
            <th>sectionName</th>
            <th>No_of_seats</th>
            <th>BOOK HERE</th>
        </tr><br>
        <?php
        while($record = mysqli_fetch_array($result))
        {
        ?>
            <tr>
                <td><?php echo $record[0];?></td>
                <td><?php echo $record[1];?></td>
                <td><?php echo $record['no_of_seats'];?></td>
                <td>Enter seats<input type="text" name="nseats"></td>
                <td><a href="login.php">login</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}
?>
