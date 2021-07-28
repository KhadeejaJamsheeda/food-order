<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php

            if(isset($_SESSION['upload']))
            {
                 echo $_SESSION['upload'];
                unset( $_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5"
                            placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                //create php code to display categories from database
                                //create sql
                                $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                                //executing query
                                $res =mysqli_query($conn, $sql);
                                //count rows to check whether we have category
                                $count =mysqli_num_rows($res);

                                if($count>0)
                                {
                                    //we have category
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get details
                                        $id =$row['id'];
                                        $title = $row['title'];
                                        ?>
                            <option value="<?php echo $id;?>"><?php echo $title; ?></option>
                            <?php
                                    }
                                }
                                else
                                {
                                    //we do not have category
                                    ?>
                            <option value="0">No Category Found</option>
                            <?php
                                }
                                //display dropdown
                            ?>


                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        //CHECK WHETHER THE BUTTON IS CLICKED
        if(isset($_POST['submit']))
        {
            //add the food in database
           // echo "Clicked";

           //get the data from form
           $title =$_POST['title'];
           $description =$_POST['description'];
           $price =$_POST['price'];
           $category =$_POST['category'];

           //check whether the radio button are checked
           if(isset($_POST['featured']))
           {
               $featured =$_POST['featured'];


           }
           else{
               $featured ="No";

           }
           if(isset($_POST['active']))
           {
               $active =$_POST['active'];
           }
           else
           {
            $active ="No";
           }
            //upload the image
            //check whether clicked or not and upload if selected
            if(isset($_FILES['image']['name']))
            {
                //get the details
                $image_name =$_FILES['image']['name'];
                
                if($image_name!="")
                {
                    //image is selected
                    //rename the image
                    //get the extention
                    $ext =end(explode('.',$image_name));
                    //create new name for image
                    $image_name ="Food-Name".rand(0000,9999).".".$ext;//new image name may be Food-Name
                    //upload image
                    //get the src path and destination path

                    //source path is current locvation of image
                    $src=$_FILES['image']['tmp_name'];

                    //destination path for image upload
                    $dst="../images/food/".$image_name;

                    //upload food image
                    $upload=move_uploaded_file($src,$dst);
                    //check image uploaded
                    if($upload==false)
                    {
                        //failed 
                        //redirect to add food 
                        $_SESSION['upload']="<div class='error'>Failed to Upload image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');

                        //stop
                        die();
                    }
                }
            }
            else
            {
                $image_name ="";//setting default as blank
            }

           //insert into database

           //create a sql query
           $sql2="INSERT INTO tbl_food SET 
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                    ";
            //execute
            $res2 = mysqli_query($conn, $sql2);
            if($res2 ==true)
            {
                $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                $_SESSION['add']="<div class='error'>Failed to add Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
           //redirect
        }
        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>