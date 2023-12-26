<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            
            <?php
            
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];       
                unset($_SESSION['login']);     
            }

            if (isset($_SESSION['noLogin'])) {
                echo $_SESSION['noLogin'];       
                unset($_SESSION['noLogin']);     
            }

            ?>
            <br><br>
            <!-- Login Form Starts -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                 <input type="text" name="username" placeholder="Enter Username"><br><br>

                 Password: <br>
                 <input type="password" name="password" placeholder="Enter Password"><br><br>  

                 <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>     
            </form>
            <!-- Login Form Ends -->

            <p class="text-center">Created By - <a href="">Muhammed Amin</a></p>
        </div>
    </body>
</html>


<?php 

if(isset($_POST['submit'])){
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $rawPass = sha1($_POST['password']);
    $Pass = mysqli_real_escape_string($conn, $rawPass);

    $sql = "SELECT * FROM tbl_admin 
            WHERE username = '$user' 
            AND   password = '$Pass'";

    $res = mysqli_query($conn, $sql); 

    $count = mysqli_num_rows($res);
     if($count == 1){

        $_SESSION['login'] = "<div class='success'>Login Successfully</div>";
        $_SESSION['user']  = $user; 
        header('location: '.SITEURL.'admin/');

     }else{

        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
        header('location: '.SITEURL.'admin/login.php');
     }
}

?>