<?php 
include "conn.php";
include 'feedback.php';
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen managment</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <nav class="navbar navbar-scrolled navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="image/logo2.png" alt="" width="57px" height="57px" class="d-inline-block align-text-top">
            </a>
            <a class="navbar-brand" href="#">
                CANTEEN VKM
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ViewOrder.php">Your Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewWishlist.php">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-bs-toggle="modal" data-bs-target="#myModal">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><?php if (isset($_SESSION['uname'])) {
                                echo "Hi ".$_SESSION['uname'];
                            } ?></a>
                    </li>

                </ul>
                <div>
                    <?php
                    if (isset($_SESSION['uname']) == "") {
                    ?>
                        <button type="button" class="btn sign-up" data-bs-toggle="modal" data-bs-target="#login-modal">login</button>
                    <?php
                    } else {
                    ?>
                        <button type="button" class="btn"><a href="logout.php" style="color: white; border:none;text-decoration:none;">Logout</a></button>
                    <?php
                    }
                    ?>

                    <a href="viewcart.php"><button type="button" class="btn mx-2" title="MyCart">
                            <i class="fas fa-shopping-cart" style="color: white; border:none;"></i><?php 
                            if (isset($_SESSION['uname'])){
                            $uid=$_SESSION['cid']; 
                            $countsql = "SELECT count(*) FROM `viewcart` WHERE CustomerID = '$uid'";
                $countresult = mysqli_query($con, $countsql);
                $countrow = mysqli_fetch_assoc($countresult);
                $count = $countrow['count(*)'];
                if (!$count) {
                    $count = 0;
                }else{
                    echo "(".$count.")";
                }
                            }?>
                        </button></a>
                </div>
                
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script>
        function myLogPassword() {
            var a = document.getElementById('Password');
            var b = document.getElementById('eye');
            var c = document.getElementById('eye-slash');
            if (a.type === "password") {
                a.type = "text"
                b.style.opacity = "0";
                c.style.opacity = "1";
            } else {
                a.type = "password"
                b.style.opacity = "1";
                c.style.opacity = "0";
            }
        }
    </script>