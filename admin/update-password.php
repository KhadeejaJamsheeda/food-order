<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>
        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php 
        //check if submit is clicked
        if(isset($_POST['submit']))
        {
            //echo "clicked";

            //get data
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            //check if the user with ccrnt id and paswd exists
            $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password= '$current_password'";
            //execute
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                //check if data is available
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    //user exist and password can be changed
                    //echo "user found";
                    //check if new and confirm match
                    if($new_password==$confirm_password)
                    {
                        //update
                        //echo "match";
                        $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                        ";
                        //execute
                        $res2 = mysqli_query($conn, $sql2);
                        //check if querry execute
                        if($res2==true)
                        {
                            //display
                            $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            //error
                            $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //redirect
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password did not Match</div>";
                        //redirect
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                }
                else
                {
                    //user does not exist
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

            //check if new and confirm passwd match

            //change password
        }
?>


<?php include('partials/footer.php') ?>