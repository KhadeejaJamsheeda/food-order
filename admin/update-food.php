<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
//check whether id is set or not
if(isset($_GET['id']))
{
    //get all the details
    $id = $_GET['id'];

    //sql query to get the selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id" ;
    //execute the query
    $res2 = mysqli_query($conn,  $sql2);
    $count2=mysqli_num_rows($res2);
            if($count2==1)
            {

    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //get the individual value 
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}
else{
    //redirect to manage food
    header('location:'. SITEURL.'admin/manage-food.php');
}
}
if(isset($_POST['submit']))
            {
                //get all details
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];

                $featured=$_POST['featured'];
                $active=$_POST['active'];
                 //upload the image if selected
                 if(isset($_FILES['image']['name']))
                 {
                    $image_name=$_FILES['image']['name'];
                    if($image_name!="")
                    {
                        //rename 
                        $ext=end(explode('.',$image_name));
                        $image_name="Food-Nmae-".rand(0000,9999).'.'.$ext ; 
                        //get the src and dest path
                        $src_path=$_FILES['image']['tmp_name'];
                        $dest_path="../images/food/".$image_name;
                        //upload image
                        $upload=move_uploaded_file($src_path,$dest_path);
                        //check uploaded
                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload new image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                            

                        }
                        //remove current image
                        if($current_image!="")
                        {
                            $remove_path="../images/food/".$current_image;

                            $remove=unlink($remove_path);

                            //check image is removed
                            if($remove==false){
                                $_SESSION['remove-failed']="<div class='error' >Failed to remove current image.</div>";
                                header('location:'.'admin/manage-food.php');
                                die();
                            }
                        
                        }

                    }
                    else{
                        $image_name=$current_image;
                    }
                 }
                 else{
                     $image_name=$current_image;
                 }
                //update the food in database
                $sql3="UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
               category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id=$id";
                $res3=mysqli_query($conn, $sql3);
                if($res3==true){
                    $_SESSION['update']="<div class='success' >Updated Successfully</div>";

                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    $_SESSION['update']="<div class='error' >Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }         
            }
        
?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>" ;>
                    </td>

                </tr>

                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if($current_image=="")
                        {
                            echo "<div class='error'>Image not available</div>";
                        }
                        else{
                            ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Select new image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                        <?php
                            //query to get active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            //check category available or not
                            if($count>0)
                            {
                                //category available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    
                                    //echo "<option value= '$category_id'>$category_title</option>";
                                    ?>
                        <option <?php if($current_category==$category_id){echo "selected";} ?>
                            value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                        <?php
                                }
                            }
                            else{
                                //category not available
                                echo "<option value='0'>Category not available. </option>";

                                }

                        ?>
                    </select>
                </td>

                </tr>
                <tr>
                    <td>
                        featured:
                    </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured"
                            value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        Active:
                    </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">

                    <td><input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php') ?>