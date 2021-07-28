<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>UserName:</td>
                    <td>
                        <input type="text" name="username" placeholder="UserName">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="Btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php') ?>

<?php
//process the value from form and save it in the database
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //button clicked

    //get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with md5

    //SQL Querry to save the data into database
    $sql = "INSERT INTO tbl_admin SET
                full_name='$full_name',
                username='$username',
                password='$password'
                ";

    // Executing Query and saving data in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    //check whether the data is inserted or not and display appropriate message
    if ($res == TRUE) {
        // echo "data inserted";
        //create session variable to display message
        $_SESSION['add'] = "Admin Added Successfully";
        //Redirect Page to manage admin page
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //create session variable to display message
        $_SESSION['add'] = "failed to add";
        //Redirect Page to add admin page
        header("location:" . SITEURL . 'admin/add-admin.php');
        //echo "failed to insert";
    }
}


?>