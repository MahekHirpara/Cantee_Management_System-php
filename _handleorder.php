<?php

session_start();
include "conn.php";
if (isset($_SESSION['uname'])) {

    $c_id = $_SESSION['cid'];
    $totalprice =  $_SESSION['totalamount'];

    $sql = "select * from viewcart where CustomerId ='$c_id' ";
    $result = mysqli_query($con, $sql);
    $type = "cash";

    $sql_check="SELECT CustomerId FROM ordertb WHERE CustomerId='$c_id'and OrderType='cash'";
    $sql_check_run=mysqli_query($con,$sql_check);
    if(mysqli_num_rows($sql_check_run) == 1)
    {
        $sql_order="SELECT * FROM ordertb where CustomerId='$c_id'";
        $sql_order_run=mysqli_query($con,$sql_order);
        $row_order =mysqli_fetch_assoc($sql_order_run);
        $orderId=$row_order['OrderId'];
        $totalamount=$row_order['total_amount'];
        if($sql_order_run)
        {
            $sql_orderiteam1 = "select * from viewcart where CustomerId ='$c_id' ";
            $result_orderiteam1 = mysqli_query($con,  $sql_orderiteam1);
            while ($row = mysqli_fetch_assoc($result_orderiteam1)) {
                $prod_id = $row['MenuId'];
                $quantity1 = $row['quantity'];
                $food_type = $row['Food_Type'];
                $amount=$totalamount+$totalprice;

                $sql_update="UPDATE ordertb SET total_amount='$amount' where OrderId='$orderId'";
                $sql_update_run=mysqli_query($con,$sql_update);
    
                $itemSql1 = "INSERT INTO `orderiteam` (`orderId`, `MenuId`, `itemquentity`,Food_type) VALUES ('$orderId', '$prod_id', '$quantity1',' $food_type')";
                $itemResult1 = mysqli_query($con, $itemSql1);
    
                $deleteQuery1 = "DELETE FROM viewcart WHERE cartid = " . $row['cartid'];
                mysqli_query($con, $deleteQuery1);
            }
            header("Location:ViewOrder.php");
        }

    }else{

    $insertQuery = "INSERT INTO ordertb ( CustomerId, MenuId, OrderType,total_amount) 
                    VALUES ( '$c_id', ' 1', '$type','$totalprice')";
    $res = mysqli_query($con, $insertQuery);
    $orderid = $con->insert_id;
    if ($res) {
        $sql_orderiteam = "select * from viewcart where CustomerId ='$c_id' ";
        $result_orderiteam = mysqli_query($con, $sql_orderiteam);
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
    header("Location:ViewOrder.php");
}
}
