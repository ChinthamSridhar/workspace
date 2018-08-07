<?php
session_start();
include 'config.php';
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role_id'] == 2){
            header('location:vendor.php');
        } else if ($_SESSION['role_id'] == 1){
                header('location:customer.php');
            } else if($_SESSION['role_id'] == 3){
                    header('location:admin.php');
                }
    }   
  ?>
<html>
<head>
<title>php and database Interaction </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var username = document.forms["myForm"]["username"].value;
            var password = document.forms["myForm"]["password"].value;
            if (username == "" || password == "") {
                alert("username and password must be filled out");
                return false;
            }
        }
    </script>
</head>
<body style="background-color:rgb(255,99,71,0.5);">
    <form  action="main.php" method="post">
        <input  type="submit" class= "btn btn-warning btn-lg" value="HOME">
    </form>
    <center><br><br>
        <h4>Login Page</h4>
        <form name="myForm" action="logindata.php" method="post" onsubmit = "return validateForm();" autocomplete="off"><br><br>
            Username <input type="text" name="username" ><br><br>
            Password <input type="password" name="password"> <br><br>
            <center><input type="submit" class= "btn btn-info" value="submit" ></center>
        </form>
            <font color="red">New User?? </font> &nbsp;<a href="register.php">SignUp</a>
    </center><br>   
</body>  
</html>
