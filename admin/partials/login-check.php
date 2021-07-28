<?php
    //authorization -access control

    //check whether user logged in or not
    if(!isset($_SESSION['user'])) //if user session not set
    {
        //user not logged in
        //redirect
        $_SESSION['no-login-message'] ="<div class='error text-center'>Please  login to  access Admin Panel.</div>";
        //redirect
        header('location:'.SITEURL.'admin/login.php');
    }
?>