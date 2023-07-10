<?php
include "conn.php";
session_start();
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
<body>

</body>
</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($uname,$email,$verify_token)
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
        $mail->addAddress($email, $uname);            
    
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Email verification from vkm canteen';
        $email_templete="
        <h2> Verification with VKMCANTEEN</h2>
        <h5> Your registation is successfull....</h5>
        <h5> Now please Login</h5>
        </br></br>
        <a href='http://localhost/project/newweb/index.php'>Click Me</a><h2>and Then Login</h2>
        ";
        $mail->Body = $email_templete;
        $mail->send();
}
?>


<?php
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $verify_token=md5(rand());

    sendemail_verify("$uname","$email","$verify_token");

    $check_email="select email from `registation` where";

    $Sql = "SELECT * FROM `registation` WHERE Email = '$email'";
    $result = mysqli_query($con, $Sql);
    $row = mysqli_num_rows($result);
    if ($row  > 0) {
        header("Location:index.php");
    } else {
        $sql = "insert into `registation`(`Username`, `Email`,`verify_token`) values('$uname','$email','$verify_token')";
        $res = mysqli_query($con, $sql);
        if ($res) {
            sendemail_verify("$uname","$email","$verify_token");
            header("Location:index.php");
        }else{
            echo "try again";
        }
     }
}
