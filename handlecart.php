<?php
include "conn.php";
session_start();
if (isset($_SESSION['uname'])) {
    if (isset($_POST['scope'])) {
        $sscope = $_POST['scope'];
        switch ($sscope) {
            case "add":
                $prod_qty = $_POST['p_qty'];
                $prod_id = $_POST['p_id'];
                $c_id = $_SESSION['cid'];

                $sql = "INSERT INTO `viewcart`(`MenuId`,`quantity`,`CustomerID`)VALUES('$prod_id','$prod_qty','$c_id')";
                $res = mysqli_query($con, $sql);

                if ($res) {
                    echo 201;
                } else {
                    echo 500;
                }
                break;
            case "update":
                $prod_qty = $_POST['p_qty'];
                $prod_id = $_POST['p_id'];
                
                $c_id = $_SESSION['cid'];
                $sql_update = "SELECT * FROM `viewcart`where MenuId='$prod_id' and CustomerID='$c_id' ";
                $sql_update_run = mysqli_query($con, $sql_update);
                if (mysqli_num_rows($sql_update_run) > 0) {
                    $update_sql = "UPDATE `viewcart` SET `quantity`='$prod_qty' WHERE `MenuId`='$prod_id' AND CustomerID='$c_id'";
                    $update_sql_run = mysqli_query($con, $update_sql);

                    if ($update_sql_run) {
                        echo 200;
                    } else {
                        echo 500;
                    }
                } else {
                    echo "somthing wrong";
                }
                break;
            case "delete":
                $cart_id = $_POST['cart_id'];
                $c_id = $_SESSION['cid'];

                $sql_delete = "SELECT * FROM `viewcart`where cartid='$cart_id' and CustomerID='$c_id' ";
                $sql_delete_run = mysqli_query($con, $sql_delete);
                
                if (mysqli_num_rows($sql_delete_run) > 0) {
                    $delete_sql = "DELETE FROM `viewcart` WHERE `cartid`='$cart_id' and CustomerID='$c_id'";
                    $delete_sql_run = mysqli_query($con, $delete_sql);

                    if ($delete_sql_run) {
                        echo 200;
                    } else {
                        echo 500;
                    }
                } else {
                    echo "somthing wrong";
                }
                break;
            
            case "addradio":
                    $prod_id = $_POST['p_id'];
                    $p_type = $_POST['p_type'];
                    echo $p_type;
                    $c_id = $_SESSION['cid'];
                        $radio_sql = "UPDATE `viewcart` SET Food_Type ='$p_type' WHERE `MenuId`='$prod_id' AND CustomerID='$c_id'";
                        $radio_sql_run = mysqli_query($con, $radio_sql);
    
                        if ($radio_sql_run) {
                            echo 200;
                        } else {
                            echo 500;
                        }
                break;
                default:
                echo 500;
        }
    }
} else {
    echo 401;
}
?>
