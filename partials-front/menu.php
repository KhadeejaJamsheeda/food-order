<?php include('config/constants.php') ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="fonts/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/google-fonts.css">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <nav>
        <div class="logo"><a href="<?php echo SITEURL; ?>"><img src="images/foods.png" alt=""></a></div>

        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><a class="active" href="<?php echo SITEURL; ?>">Home</a></li>
            <li>
                <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
            </li>
            <li>
                <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
            </li>
            <li>
                <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
            </li>
            <li>
                <a href="<?php echo SITEURL; ?>aboutus.php">About Us</a>
            </li>
        </ul>
    </nav>

    <div class="clearfix"></div>

    <!-- Navbar Section Ends Here -->