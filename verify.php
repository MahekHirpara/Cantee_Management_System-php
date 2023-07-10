<?php
session_start();
include "razorpay-php/Razorpay.php";
include "conn.php";
?>

<div class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card ">
                    <div class="card-body">
                        <h5>payment verification</h5>
                        <hr>

                        <div class="row">
                            <?php


                            use Razorpay\Api\Api;
                            use Razorpay\Api\Errors\SignatureVerificationError;

                            $success = true;
                            include "gateway-config.php";
                            $error = "Payment Failed";

                            if (empty($_POST['razorpay_payment_id']) === false) {
                                $api = new Api($keyId, $keySecret);

                                try {
                                    // Please note that the razorpay order ID must
                                    // come from a trusted source (session here, but
                                    // could be database or something else)
                                    $attributes = array(
                                        'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                                        'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                                        'razorpay_signature' => $_POST['razorpay_signature']
                                    );

                                    $api->utility->verifyPaymentSignature($attributes);
                                } catch (SignatureVerificationError $e) {
                                    $success = false;
                                    $error = 'Razorpay Error : ' . $e->getMessage();
                                }
                            }

                            if ($success === true) {

                                $fname = $_SESSION['fname'];
                                $lname = $_SESSION['lname'];
                                $email = $_SESSION['E-mail'];
                                $phone = $_SESSION['phone'];

                                $c_id = $_SESSION['cid'];
                                $totalprice =  $_SESSION['totalamount'];
                                $posted_hash = $_SESSION['razorpay_order_id'];
                                if (isset($_POST['razorpay_payment_id'])) {
                                    $txnid = $_POST['razorpay_payment_id'];
                                    $amount =  $_SESSION['totalamount'];
                                    $status = "success";
                                    $eid = $_POST['shopping_order_id'];
                                    $key_value = "pkpmt";
                                    $currency = "INR";
                                    $date = new DateTime(null, new DateTimeZone("Asia/Kolkata"));
                                    $payment_date = $date->format('Y-m-d H:i:s');

                                    $sql_count = "select * from payment where txnid='$txnid'";
                                    $sql_res1 = mysqli_query($con, $sql_count);
                                    if ($txnid != '') {
                                        if (mysqli_num_rows($sql_res1) == 0) {
                                            $sql = "select * from viewcart where CustomerId ='$c_id' ";
                                            $result = mysqli_query($con, $sql);
                                            $type = "online"; {

                                                $insertQuery = "INSERT INTO ordertb ( CustomerId, MenuId, OrderType,total_amount) 
                                                                VALUES ( '$c_id', ' 1', '$type','$amount')";
                                                $res = mysqli_query($con, $insertQuery);
                                                $orderid = $con->insert_id;
                                                if ($res) {
                                                    $sql_orderiteam = "select * from viewcart where CustomerId ='$c_id' ";
                                                    $result_orderiteam = mysqli_query($con, $sql);
                                                    while ($row = mysqli_fetch_assoc($result_orderiteam)) {
                                                        $product_id = $row['MenuId'];
                                                        $quantity = $row['quantity'];
                                                        $f_type = $row['Food_Type'];

                                                        $itemSql = "INSERT INTO `orderiteam` (`orderId`, `MenuId`, `itemquentity`,Food_type) VALUES ('$orderid', '$product_id', '$quantity',' $f_type')";
                                                        $itemResult = mysqli_query($con, $itemSql);

                                                        $deleteQuery = "DELETE FROM viewcart WHERE cartid = " . $row['cartid'];
                                                        mysqli_query($con, $deleteQuery);
                                                    }
                                                }
                                                $sql_payment = "INSERT INTO `payment`(`payment_date`, `fname`, `lname`, `amount`, `status`, `txnid`, `email`, `OrderId`, `currency`, `mobile`) VALUES 
                                                ('$payment_date','$fname','$lname','$amount','$status','$txnid','$email','$orderid','$currency','$phone')";

                                                $sql_payment_run = mysqli_query($con, $sql_payment);
                                                if ($sql_payment_run) {
                                                    header("Location:ViewOrder.php");
                                                }
                                            }
                                        } else {
                                            echo "fail";
                                        }
                                    }
                                }
                            } else {
                                $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
                                echo $html;
                            } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>