<?php
include "conn.php";
if (isset($_POST['scope1'])) {
    $sscope = $_POST['scope1'];
    switch ($sscope) {
        case "update":
            $orderid = $_POST['order_id'];
            $customerid = $_POST['customer_id'];
            $status = $_POST['status'];
            $sql_update = "SELECT * FROM `ordertb`where OrderId='$orderid' and CustomerID='$customerid' ";
            $sql_update_run = mysqli_query($con, $sql_update);
            if (mysqli_num_rows($sql_update_run) > 0) {
                $update_sql = "UPDATE `ordertb` SET `status`='$status'  WHERE `OrderId`='$orderid' AND CustomerID='$customerid'";
                $update_sql_run = mysqli_query($con, $update_sql);

                if ($update_sql_run) {
                    echo 200;
                } else {
                    echo 500;
                }
            } else {
                echo "somthing wrong";
            }
    }
}
else {
    echo "somthing wrong";
}
?>
