
<?php 
session_start();
if($_SESSION == NULL){
    header('location:main.php');
}
include 'config.php';
$query = "update log_user set logout_time = now() where user_id=".$_SESSION['user_id'];
$result = mysqli_query($conn,$query);

//unset($_SESSION['username']);
//unset($_SESSION['password']);
unset($_SESSION['user_id']);
unset($_SESSION['role_id']);
unset($_SESSION['login_attemp']);
session_destroy();
header('Location: main.php');
?>




