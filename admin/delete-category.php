<?php
    include('../config/constants.php');
    //check whether the id and image name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name= $_GET['image_name'];
        //remove physical file if available
        if($image_name!="")
        {
            //remove it
            $path="../images/category/".$image_name;
            //remove the imagee
            $remove=unlink($path);

            if($remove==false)
            {
                //session message 
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //redirect manage category
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop
                die();

            }
        }

        //delete data from database
        $sql="DELETE FROM tbl_category WHERE id=$id";
        //execute
        $res=mysqli_query($conn,$sql);
        //check data deleted or not
        if($res==true)
        {

            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page

    }
    else{

       
       header('location:'.SITEURL.'admin/manage-category.php');

    }
?>