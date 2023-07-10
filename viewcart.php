<?php
session_start();
include "conn.php";
include "loginmodal.php";
include "singupmodal.php";
include "header.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>canteen managment System</title>
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5 product_data">
        <?php include 'conn.php';
        if (isset($_SESSION['uname'])) {
        ?>
            <div id="mycart">
                <?php
                $c_id = $_SESSION['cid'];
                $view_category = "select c.cartid ,c.quantity,c.customerId,c.MenuId,c.Food_Type,m.Price, m.Image,m.FoodName from menutb m,viewcart c where m.MenuId = c.MenuId and customerId ='$c_id' ";
                $result = mysqli_query($con, $view_category);
                $counter = 0;
                $totalcount = 0;
                $totalPrice=0;
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <div class="header">
                        <h2 class="text-center">Your Cart Iteams</h2>
                    </div>
                    <div class="body mt-5">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">QUTITY</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">REMOVE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   
                                while ($row = mysqli_fetch_array($result)) {
                                   
                                    $foodtype = $row['Food_Type'];
                                    $counter++;
                                ?>
                                    <tr class="product_data">
                                        <td><img src="admin/<?php echo $row['Image']; ?>" width="100px" height="100px"></td>
                                        <td><?php echo $row['FoodName']; ?></td>
                                        <td><?php echo $row['Price']; ?></td>
                                        <td>

                                            <input type="hidden" class="prodId" value="<?php echo $row['MenuId'] ?>">
                                            <div class="input-group mb-3" style="width:130px;">
                                                <button class="input-group-text decrement-btn updateQty">-</button>
                                                <input type="text" class="form-control text-center input-qty bg-white" value="<?php echo $row['quantity']; ?>" disabled>
                                                <button class="input-group-text increment-btn updateQty">+</button>
                                            </div>

                                        </td>
                                        <td>
                                            <input type="hidden" class="prodId" value="<?php echo $row['MenuId'] ?>">
                                            <div class="form-check">
                                                <?php
                                                $jainchecked = ($foodtype === $row['MenuId'] . "=jain") ? 'checked' : '';
                                                echo '<input class="form-check-input optionvalue" value="jain" type="radio" name="' . $row['MenuId'] . '" id="flexRadioDefault1"' . $jainchecked . '>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    jain
                                                </label> ' ?>
                                            </div>
                                            <div class="form-check">
                                                <?php
                                                $regularchecked = ($foodtype === $row['MenuId'] . "=regular") ? 'checked' : '';
                                                echo '<input class="form-check-input optionvalue" value="regular" type="radio" name="' . $row['MenuId'] . '" id="flexRadioDefault1"' . $regularchecked . '>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Regular
                                                </label> ' ?>
                                            </div><br>
                                        </td>
                                        <td><button class="btn deleteiteam" value="<?php echo $row['cartid'] ?>"><i class="bi bi-trash3"></i>Remove</button></td>
                                    </tr>
                                    
                                <?php 
                                 $totalPrice += $row['quantity'] * $row['Price'];
                                $totalcount = $counter;
                                    $_SESSION['totalcount'] = $totalcount;
                                }?>
                                <div class="float-end mb-5">
                        <!-- <button type="button" class="btn" style="background-color:#954535;"><a href="checkout.php" style="text-decoration:none;color:white">Process to checkout</a></button> -->
                        <button type="button" class="btn"><a href="checkout.php" style="text-decoration: none;font:bold ;color:white;">Process to checkout</a></button>
                        <button type="button" class="btn"><?php echo  $totalPrice ;?></button>
                    </div>
                                <?php
                            } else {
                                ?>
                                <div class="header">
                                    <h2 class="text-center">Your Cart is empty</h2>
                                    <h1 class="text-center"><i class="fas fa-shopping-cart"></i>
                                        <h1>
                                </div>
                                <div class="float-end">
                        <!-- <button type="button" class="btn" style="background-color:#954535;"><a href="checkout.php" style="text-decoration:none;color:white">Process to checkout</a></button> -->
                        <button type="button" class="btn"><a href="checkout.php" style="text-decoration: none;font:bold ;color:white;">Process to checkout</a></button>
                    </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="header">
                                <h2 class="text-center">Your Cart is empty</h2>
                                <h1 class="text-center"><i class="fas fa-shopping-cart"></i>
                                </h1>
                                <?php
                                 echo '<div class="container" style="min-height : 610px; margin-top:200px;">
                                 <div class="alert alert-info my-3">
                                     <font style="font-size:22px"><center>Check your Order. You need to <strong><a class="" data-bs-toggle="modal" data-bs-target="#login-modal">Login</a></strong></center></font>
                                 </div></div>';
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>

                    
            </div>
            <?php

            ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="custome.js">
    </script>
</body>

</html>