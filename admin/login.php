<?php include('../config/constants.php');

?>



<html>

<head>
    <title>Login -Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">

        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset( $_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset( $_SESSION['no-login-message']);
        }
         
        
        ?>
        <br><br>
        <!-- Login starts here -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <p class="text-center">Created By - <a href="www.xyz.com">abc</a>
        </p>
    </div>
</body>

</html>
<?php 
    //check whether the submit is clicked
    if(isset($_POST['submit']))
    {
        //process for login
        //get data
        $username =mysqli_real_escape_string($conn,$_POST['username']);
        $raw_password=md5($_POST['password']);
        $password =mysqli_real_escape_string($conn,$raw_password);

        //sql to check if user exist
        $sql ="SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";
        //execute the query
        $res =mysqli_query($conn, $sql);

        //check whether user exist or not
        $count =mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login success
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;//check whether user is logged in or not and logout will unset it
            //redirect
            header('location:'.SITEURL.'admin/');


        }
        else
        {
            //user not available and login fail
             //user available and login success
             $_SESSION['login'] = "<div class='error text-center'>Username or Password Did Not Match</div>";
             //redirect
             header('location:'.SITEURL.'admin/login.php');
 


        }

    }
?>