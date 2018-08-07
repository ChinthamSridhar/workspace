<?php
session_start();
include('config.php');
    if(isset($_SESSION['user_id'])){
       if($_SESSION['role_id'] == 1){
           header('location:maindup.php');
       } else if ($_SESSION['role_id'] == 2){
           header('location:vendor.php');
       }
   }
     $name=$_POST['username'];
     $pass=$_POST['password'];
     $email=$_POST['email'];
     $role=$_POST['role'];    
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
    <form action="register.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="BACK">
    </form>
<?php
    if($name!=NULL && $pass!=NULL && $email!=NULL)
    {   
    $sql="select * from user where username='$name' ";
    $result1=mysqli_query($conn,$sql);
    $data = mysqli_fetch_array($result1, MYSQLI_NUM);
    if($data[0]>1){ 
        echo "User Already in Exists<br/>";
        }
    else
        {
        $log="insert into user(username,password,email) values('$name','$pass','$email')";
        $result=mysqli_query($conn,$log);
            if($result)
                {
                 $_SESSION['login_attemp'] = 1;
                $last_id = mysqli_insert_id($conn);
                $sql="insert into user_roles(user_id,role_id) values('$last_id','$role')";
                $result1=mysqli_query($conn,$sql);
                echo "<h1>"."user is added successfully"."</h1>";
                if($result)
                    {
                    $query = "select id from user u where username='".$_POST['username']."' and password='".$_POST['password']."'";
                    //print_r($query);die;
                    $result=mysqli_query($conn,$query);
                    if($result)
                        {  
                        $record = $result ->fetch_assoc();
                            if($record)
                            {
                            $query = "insert into log_user(user_id,status,login_time) values('$record[id]',1,now())";
                            $result = mysqli_query($conn,$query);
                            $query = "select r.id,r.role_name from user_roles ur left join roles r on ur.role_id=r.id where ur.user_id=".$record['id'];
                            $result = mysqli_query($conn,$query);
                            $role = $result->fetch_assoc();
                                if($role['role_name'] == 'vendor')
                                {
                                    $_SESSION['user_id'] = $record['id'];
                                    $_SESSION['role_id'] = $role['id'];
                                    header('location:vendor.php');
                                } else if($role['role_name'] == 'customer')
                                    {
                                        $_SESSION['user_id'] = $record['id'];
                                        $_SESSION['role_id'] = $role['id'];
                                        header('location:maindup.php');
                                    } else if($role['role_name'] == 'admin')
                                        {
                                            $_SESSION['user_id'] = $record['id'];
                                            $_SESSION['role_id'] = $role['id'];
                                            header('location:admin.php');
                                        }else {
                                            echo "role unknown"."&emsp;";
                                            }
                                        echo 'login success.';            
                                } else {
                                    echo 'Login failed. Try again.';
                                }
                                } else {
                                    echo 'Login failed. Try again.';
                                }
                            }
               
                        }
                    }
            }
else
{
     echo "<center>please fill all the details</center>";  
}
?>

