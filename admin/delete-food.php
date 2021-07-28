<?php
    //include
    include('../config/constants.php');
    //echo "Delete food";
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //process to delete
        //echo "Process to delete";
        //get id
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //check availability
        if($image_name!="")
        {
            //has image
            $path = "../images/food/".$image_name;
            //remove
            $remove = unlink($path);
            //check if image is remove
            if($remove==false)
            {
                //failed
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
                //redirect
                header('location: '.SITEURL.'admin/manage-food.php');
                die();
            }

        }
        //delete food from database
        $sql= "DELETE FROM tbl_food WHERE id=$id";
        $res=mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
            header('location: '.SITEURL.'admin/manage-food.php');

        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";
            header('location: '.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        //redirect
        $_SESSION['unauthorized']= "<div clasas ='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>