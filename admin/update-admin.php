<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
            //get id of selected admin
            $id=$_GET['id'];
            //create sql
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            //execute
            $res=mysqli_query($conn, $sql);
            //check if the querry is executed
            if($res==true)
            {
                //check if the data is available 
                $count = mysqli_num_rows($res);
                //check if we have admin data or not
                if($count==1)
                {
                    //get details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }


        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>

</div>
<?php
    //check if the submit button is clicked
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from the form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //create sql querry 
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'
        ";
        //Execute querry
        $res = mysqli_query($conn, $sql);
        //check
        if($res==true)
        {
            //executed
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }


?>


<?php include('partials/footer.php') ?>