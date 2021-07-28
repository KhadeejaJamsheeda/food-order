<?php
    //include constant.php here
    include('../config/constants.php');
   //get id of admin to be deleted
    $id = $_GET['id'];
   //create sql querry to delete admin
   $sql = "DELETE FROM tbl_admin WHERE id=$id";

   //execute
   $res = mysqli_query($conn, $sql);
   //check if the querry is execute or not
   if($res==true)
   {
       //executed successfully
        //echo "Admin Deleted";
        //create session variable to display meassage
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
   }
   else{
       //failed
       //echo "Failed to delete";
       $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');

   }

   //redirect to manage admin page with message (s/error)
?>