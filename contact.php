 <?php include('partials-front/menu.php');?>

 <?php
     if(isset($_SESSION['submit']))
     {
        echo $_SESSION['submit'];
        unset( $_SESSION['submit']);
     }
    ?>
 <section class="food-search">

     <div class="container">
         <h2 class="text-center text-white">Contact Us</h2>

         <form action="" method="POST" class="order">
             <fieldset>
                 <legend>Let's Connect</legend>

                 <div class="order-label">Name</div>
                 <input type="text" name="name" placeholder="E.g. Anusha" class="input-responsive" required />
                 <div class="order-label">Email</div>
                 <input type="email" name="email" placeholder="E.g. hi@anusha.com" class="input-responsive" required />

                 <div class="order-label">Message</div>
                 <textarea name="message" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                     required></textarea>
                 <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
             </fieldset>
         </form>
         <?php
            if(isset($_POST['submit']))
            {
                $name=$_POST['name'];
                $email=$_POST['email'];
                $message=$_POST['message'];
            
            $sql="INSERT INTO tbl_contact SET 
                    name='$name',
                    email='$email',
                    message='$message'";

                     $res=mysqli_query($conn, $sql );
                     if($res==true)
                     {
                         $_SESSION['submit']="<div class='success text-center'>Submitted Successfully.</div>";
                         header('location:'.SITEURL.'contact.php');
                     }
                     else{
                         $_SESSION['order']="<div class='error text-center'>Failed to Submit.</div>";
                         header('location:'.SITEURL.'contact.php');
                     }
                    }
                    ?>




     </div>
 </section>



 <?php include('partials-front/footer.php'); ?>