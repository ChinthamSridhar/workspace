
<?php
    session_start();
    include 'config.php';
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role_id'] == 2){
            header('location:vendor.php');
        } else if ($_SESSION['role_id'] == 1){
            header('location:maindup.php');
        }
        else if($_SESSION['role_id'] == 3)
        {
           header ('location:admin.php');
        }
    }
    $query = "select id,username,password from user u where username='".$_POST['username']."' and password='".$_POST['password']."'";
    $result = mysqli_query($conn,$query);
    if($result){
        $_SESSION['login_attemp'] = 1;
        $record = $result->fetch_assoc();
        if($record){
            $query = "insert into log_user(user_id,status,login_time) values('$record[id]',1,now())";
            $result = mysqli_query($conn,$query);
            
            $query = "select r.id,r.role_name from user_roles ur left join roles r on ur.role_id=r.id where ur.user_id=".$record['id'];
            $result = mysqli_query($conn,$query);
            $role_name = $result->fetch_assoc();
            if($role_name['role_name'] == 'vendor')
            {
                $_SESSION['user_id'] = $record['id'];
                $_SESSION['role_id'] = $role_name['id'];
                header('location:vendor.php');
            } else if($role_name['role_name'] == 'customer')
            {
                $_SESSION['user_id'] = $record['id'];
                $_SESSION['role_id'] = $role_name['id'];
                header('location:maindup.php');
            } else if($role_name['role_name'] == 'admin')
            {
                $_SESSION['user_id'] = $record['id'];
                $_SESSION['role_id'] = $role_name['id'];
                header('location:admin.php');
            }
            
            else {
                echo "role unknown <br>";
            }
            echo 'login success.';         
            
            echo "<html>
                <body> 
                   <p>Please Logout Here...</p> 
                   <form action='logout.php' method='post'>
                   <input type='submit' value='logout'>
                   </form>
                </body>
              </html>";
            
            
        } else {
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
    <body>
        <form action="login.php" method="post">
            <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
        </form>
    </body>  
    <?php
    echo '<center><h4>Login failed. Try again</h4></center>';
    //echo"<a href='login.php'>Login</a>";
        }
    } 
else 
{
    echo 'Login failed. Try again.';
}
?>
