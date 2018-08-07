
<?php
session_start();
include 'config.php';
       if(isset($_SESSION['user_id']))
       {
            if($_SESSION['role_id'] == 2)
                {
                    header('location:vendor.php');
                } 
           else if ($_SESSION['role_id'] == 1)
                 {
                    header('location:customer.php');
                }
         }   
    $res=mysqli_query($conn,"select * from roles WHERE role_name NOT IN('admin')");
  ?>
<html>
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
        function validateForm() {
        var username = document.forms["myForm"]["username"].value;
        var password = document.forms["myForm"]["password"].value;
        var email = document.forms["myForm"]["email"].value;
        if (username == "" || password == "" || email == "") {
            alert("username and password,email must be filled out");
            return false;
        }
            else if(username.length < 8){
                    alert("username should be 8 characters or more");
                    return false;
            }
        if(password.length < 8){
            alert("password should contain minimum 6 characters");
        }
        }
    </script>
    </head>
    <body style=background-color:lightgrey>
        <form action="main.php" method="post">
            <input  type="submit" class= "btn btn-warning btn-lg" value="HOME">
        </form>
        <center>
             <h6>
                 <font color="Green" size="6">Register Here</font>
            </h6>
            <fieldset style="width:300">
            <form name="myForm" action="Registerdata.php" method="post" onsubmit = "return validateForm();" autocomplete="off">
                <p>Username&emsp;<input type="text" name="username"><br><br>
                Password  &emsp;<input type="password" name="password"><br><br>
                Email &emsp; &emsp;<input type="email" name="email"><br><br>
                Role &emsp; 
                <select required name = "role" > 
                    <option >select</option>
                    <?php
                    while($row = mysqli_fetch_array($res))
                    {
                    ?>
                        <option name="id in roles" value="<?php echo $row['id']; ?>"> <?php echo $row['role_name']; ?></option>
                    <?php
                    } 
                    ?>
                </select><br><br><br>
                &emsp;<input type="submit" class="btn btn-info" value="submit">
            </form>
            </fieldset><br><br>
        <font color="red">Already Existing User?? </font> &nbsp;<a href="Login.php">Login</a>
        </center>
    </body>
</html>