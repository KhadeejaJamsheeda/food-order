<?php
    include('../config/constants.php');
    
    //destroy
    session_destroy();//unset $_SESSION['user]

    //redirect
    header('location:'.SITEURL.'admin/login.php');


?>