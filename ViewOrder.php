<?php

include "header.php";
include "_orderIteamModal.php";
include "conn.php";
include "loginmodal.php";
include "singupmodal.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<style>
    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;

        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #954535;

    }

    .track .step.active:before {
        background: #954535;

    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px;

    }

    .track .step.active .icon {
        background: #954535;
        color: white
    }

    .track .step.deactive:before {
        background: #030303;
    }



    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
</style>

<body>
    <?php
    if (isset($_SESSION['uname'])) {
        $c_id = $_SESSION['cid'];

    ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5">
                    <div class="card wish-list h-100 border-0 ">
                        <div class="card-body mt-5">
                            <?php $statusmodalsql1 = "SELECT * FROM `ordertb` WHERE `CustomerId`= $c_id";
                            $statusmodalresult1 = mysqli_query($con, $statusmodalsql1);
                            if (mysqli_num_rows($statusmodalresult1) == 0) {
                                echo '<h1>please order frist....</h1>';
                            } else {
                                echo '<h1>Your order is<br> Succsessfully placed.......</h1><br>Thank You for order....';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $statusmodalsql = "SELECT * FROM `ordertb` WHERE `CustomerId`= $c_id";
                $statusmodalresult = mysqli_query($con, $statusmodalsql);


                while ($statusmodalrow = mysqli_fetch_assoc($statusmodalresult)) {
                    $orderid = $statusmodalrow['OrderId'];
                    $status = $statusmodalrow['status'];
                    if ($status == 0)
                        $tstatus = "pending";
                    elseif ($status == 1)
                        $tstatus = "Order Confirm";
                    elseif ($status == 2)
                        $tstatus = "Order Prepared";
                    elseif ($status == 3)
                        $tstatus = "Order ready";
                    else
                        $tstatus = "Order Cancelled.";
                }

                ?>
                <div class="col-lg-5 mt-5">
                    <h1>order status</h1>

                    <article class="card border-0">
                        <div class="card-body">
                            <div class="track">
                                <?php
                                if (mysqli_num_rows($statusmodalresult) == 0) {
                                    echo '<div class="step" > <span class="icon" > <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Order Confirmed</span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Prepared</span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Done </span> </div>
                                        ';
                                }
                                ?>
                                <?php
                                if (isset($status)) {
                                    if ($status == 0) {
                                        echo '<div class="step active" > <span class="icon" > <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                            <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Order Confirmed</span> </div>
                                            <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Prepared</span> </div>
                                            <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Done </span> </div>';
                                    } elseif ($status == 1) {
                                        echo '<div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Confirmed</span> </div>
                                          <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Prepared</span> </div>
                                          <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Done </span> </div>
                                          ';
                                    } elseif ($status == 2) {
                                        echo '<div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Confirmed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text"> Order Prepared</span> </div>
                                          <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order Done </span> </div>
                                         ';
                                    } elseif ($status == 3) {
                                        echo '<div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Confirmed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text"> Order Prepared</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-times" style="color:white"></i> </span> <span class="text"> Order Done </span> </div>
                                          ';
                                    } elseif ($status == 4) {
                                        echo '<div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Confirmed</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text"> Order Prepared</span> </div>
                                          <div class="step active"> <span class="icon"> <i class="fa fa-times" style="color:white"></i> </span> <span class="text"> Order Done</span> </div>
                                         ';
                                    } elseif ($status == 5) {
                                        echo '<div class="step active"> <span class="icon"> <i class="fa fa-check" style="color:white"></i> </span> <span class="text">Order Placed</span> </div>
                                          <div class="step deactive"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Order Denied.</span> </div>';
                                    } else {
                                        echo '<div class="step deactive"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Order Cancelled.</span> </div>';
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </article>

                </div>
            </div>
            <div class="row">
                <div class="table-wrapper" id="empty">
                    <div class="table-title" style="margin-top:100px">
                        <div class="row">
                            <div class="col-sm-4">
                                <h2>Order <b>Details</b></h2>
                            </div>
                        </div>
                    </div>
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>CustomerId</th>
                                <th>Order type</th>
                                <th>total_Amount</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `historyorder` WHERE `CustomerId`= '$c_id'";
                            $result = mysqli_query($con, $sql);
                            $counter = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $orderId = $row['Orderid'];
                                $custid = $row['CustomerId'];
                                $ordertypet = $row['OrderType'];
                                $total_price = $row['Amount'];
                                $counter++;

                                echo '<tr>
                                    <td>' . $counter . '</td>
                                    <td>' . $custid . '</td>
                                    <td>' . $ordertypet . '</td>
                                    <td>' . $total_price . '</td>
                                    <td><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#orderItem' . $orderId . '">
                                    <i class="bi bi-menu-button-wide" style="color:white;"></i>
                                  </button></td>
                                </tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
    } else {
        echo '<div class="container" style="min-height : 610px; margin-top:200px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Check your Order. You need to <strong><a class="" data-bs-toggle="modal" data-bs-target="#login-modal">Login</a></strong></center></font>
        </div></div>';
    }
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                 location.reload();
                },10000);
            });


        </script>
</body>

</html>