<?php
session_start();
include "conn.php";
if (!isset($_SESSION['cid'])) {

    header('location:index.php');
} else {
    $userId = $_SESSION["cid"];
    $m_id =$_GET['mid'];

    $sql_Check = "SELECT * FROM wishlist where CustomerId = $userId  AND MenuId = $m_id";
    $result_check = mysqli_query($con, $sql_Check);

    if (mysqli_num_rows($result_check) == 1) {
        $sql_del = "delete FROM wishlist where  CustomerId = $userId  AND MenuId = $m_id";
        $result_del = mysqli_query($con, $sql_del);
        header('location:viewWishlist.php');
       
    } else {
        $insertWishlist = "INSERT INTO wishlist ( CustomerId, MenuId,flag) VALUES ('$userId','$m_id','1' )";
        if (mysqli_query($con, $insertWishlist)) {
            header('location:viewWishlist.php');
       
       }
    }
}
?>