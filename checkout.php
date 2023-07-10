<?php
session_start();
include "conn.php";
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
    <?php if ($_SESSION['uname']) { ?>
        <div class="container mt-5" id="cont">
            <div id="mycart">
                <div class="row">
                    <div class="col-lg-12 text-center border rounded bg-light my-3">
                        <h1>My Cart</h1>
                    </div>
                    <div class="col-lg-8">
                        <div class="card wish-list mb-3">
                            <table class="table text-center" id="mytable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Item Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">type</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $c_id = $_SESSION['cid'];
                                    $sql = "select c.cartid ,c.quantity,c.customerId,c.MenuId,c.Food_Type,m.Price, m.Image,m.FoodName from menutb m,viewcart c where m.MenuId = c.MenuId and customerId ='$c_id' ";
                                    $result = mysqli_query($con, $sql);
                                    $counter = 0;
                                    $totalPrice = 0;
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            $counter++;
                                    ?>
                                            <tr class="product_data">
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $row['FoodName']; ?></td>
                                                <td><?php echo $row['Price']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['quantity']*$row['Price']; ?></td>
                                                <td><?php echo $row['Food_Type']; ?></td>

                                            </tr>
                                    <?php
                                            $totalPrice += $row['quantity'] * $row['Price'];
                                            $_SESSION['totalamount'] = $totalPrice;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card wish-list mb-3">
                            <div class="pt-4 border bg-light rounded p-3">
                                <h5 class="mb-3 text-uppercase font-weight-bold text-center">Order summary</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center  px-0 bg-light">Total Price<span>Rs. <?php echo $totalPrice ?></span></li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
                                        <div>
                                            <strong>The total amount of</strong>
                                            <strong>
                                                <p class="mb-0">(including Tax & Charge)</p>
                                            </strong>
                                        </div>
                                        <span><strong>Rs. <?php echo $totalPrice;
                                                            ?></strong></span>
                                    </li>
                                </ul>
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn cash" style="background-color:#954535; color:white"><a href="_handleorder.php" style="color:white;text-decoration:none;">cash paymant</a></button>
                                    <button type="button" class="btn" style="background-color:#954535; color:white"><a href="_onlineOrder.php" style="color:white;text-decoration:none;">online paymant</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else{
                    echo '<div class="container" style="min-height : 610px; margin-top:200px;">
                    <div class="alert alert-info my-3">
                        <font style="font-size:22px"><center>Check your Order. You need to <strong><a class="" data-bs-toggle="modal" data-bs-target="#login-modal">Login</a></strong></center></font>
                    </div></div>';
                } ?>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
                <script src="custome.js">
                </script>
</body>

</html>