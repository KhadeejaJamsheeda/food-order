<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset( $_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset( $_SESSION['upload']);
            }
        ?>
        <br><br>
        <!-- add category form starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="Btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add category end here-->
        <?php
            //check whether subit button clicked
            if(isset($_POST['submit']))
            {
               // echo "clickes";
               //get the value from category form
               $title=$_POST['title'];
               //for radio input type check button selected or not
               if(isset($_POST['featured']))
               {
                   //get the value from form
                   $featured=$_POST['featured'];
               }
               else{
                   //set the default value
                   $featured="No";
               }
               if(isset($_POST['active']))
               {
                   $active=$_POST['active'];
               }
               else{
                    $active="No";
               }
               //check image selected or not and set the value for image name
              // print_r($_FILES['image']);
              // die();//break the code here

              if(isset($_FILES['image']['name']))
              {
                  //upload the image
                  //to upload image we need image name,source path and destination path
                  $image_name=$_FILES['image']['name'];

                  //upload image only if image is selected
                  if($image_name !="")
                  {

                  //Auto rename image
                  //get the extension of our image(jpg,png, etc)
                  $ext=end(explode('.',$image_name));
                  //rename 
                  $image_name="Food_Category_".rand(00,999).'.'.$ext;


                  $source_path=$_FILES['image']['tmp_name'];
                  $destination_path="../images/category/".$image_name;
                  //upload the image
                  $upload=move_uploaded_file($source_path,$destination_path);
                  //check image uploaded or not
                  //if the image is not uploaded then stop the process and redirect with error message
                  if($upload==false)
                  {
                      //set message
                      $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                      //redirect to add category page
                      header('location:'.SITEURL.'admon/add-category.php');
                      //stop the process
                      die();
                  }
                }

              }
              else{
                  //dont upload image and set the image_name as blank
                  $image_name="";
              }
               //create sql query to insert
               $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";
                //execute and save
                $res=mysqli_query($conn,$sql);
                //check query executed or not and data added or not
                if($res==true)
                {
                    //query executed
                    $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed
                     //query executed
                     $_SESSION['add']="<div class='error'>Failed to add Category</div>";
                     //redirect
                     header('location:'.SITEURL.'admin/add-category.php');
                }
        
            }
        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>