<?php
session_start();
include "conn.php";
$c_id = $_SESSION['cid'];
$orderid = $_GET['oid'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_email_order($get_email,$get_name)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mahekhirpara63@gmail.com';
    $mail->Password   = 'aqzkghgnkcqyhhyt';                                //SMTP password
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mahekhirpara63@gmail.com', 'VKMCANTEEN');
    $mail->addAddress($get_email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Order pick';
    $email_templete = "
        <h2> Hello $get_name</h2>
        <h5>Your Order is ready please pick your order from counter.</h5>
        </br></br>
        ";
    $mail->Body = $email_templete;
    $mail->send();
}

$sql_email = "SELECT o.*,r.id,r.Email,r.Username from ordertb o,registation r WHERE r.id=o.CustomerId AND o.CustomerId='$c_id' AND OrderId='$orderid'";
$sql_email_run = mysqli_query($con, $sql_email);
if ($sql_email_run) {
    $row = mysqli_fetch_assoc($sql_email_run);
    $get_email = $row['Email'];
    $get_name = $row['Username'];
    send_email_order($get_email,$get_name);

    $sql = "select * from ordertb where OrderId='$orderid'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $cid = $row['CustomerId'];
    $Type = $row['OrderType'];
    $Amount = $row['total_amount'];
    $date = $row['addedate'];
     
    $sql_insertiteam = "select * from orderiteam where OrderId='$orderid'";
    $sql_insertiteam_run = mysqli_query($con, $sql_insertiteam);

    while ($row_iteam = mysqli_fetch_assoc($sql_insertiteam_run)) {
        $product_id = $row_iteam['MenuId'];
        $qty = $row_iteam['itemquentity'];
        $Food_type = $row_iteam['Food_Type'];

        $itemSql = "INSERT INTO `historyiteam` (`orderid`, `MenuId`, `iteamquentity`,`Food_Type`,`CustomerId`) VALUES ('$orderid', '$product_id', '$qty',' $Food_type','$cid')";
        $itemResult = mysqli_query($con, $itemSql);

        $sql_delete_iteam = "delete from orderiteam  where OrderId='$orderid'";
        $sql_deleteiteam_run = mysqli_query($con, $sql_delete_iteam);
    }

    $sql_insert = "insert into historyorder(Orderid,CustomerId,OrderType,Amount,addedate)values('$orderid','$cid','$Type','$Amount','$date')";
    $sql_insert_run = mysqli_query($con, $sql_insert);

    $sql_delete = "delete from ordertb where OrderId='$orderid'";
    $sql_delete_run = mysqli_query($con, $sql_delete);

    
} else {
    header("Location:ViewOrder.php");
}
header("Location:ViewOrder.php");
?>