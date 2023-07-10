
<?php
session_start();
include 'conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_email,$token)
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
    $mail->Subject = 'Reset Password Notification';
    $email_templete = "
        <h2> Hello</h2>
        <h5>You are receving this E-mail because we received a password reset request for your account.</h5>
        </br></br>
        <a href='http://localhost/project/newweb/admin/change_password.php?token=$token&email=$get_email'>Click Me</a><h2>and Then Login</h2>
        ";
    $mail->Body = $email_templete;
    $mail->send();
}


if (isset($_POST['submit'])) {
    $errormsg="";
    $email = $_POST['email'];
    $token = md5(rand());
    $qry = "select Email from admin_login where Email = '$email'";
    $res = mysqli_query($con, $qry);
    if (mysqli_num_rows($res) === 1) {
        $row = mysqli_fetch_assoc($res);
        $get_email = $row['Email'];
        $update_token = "update admin_login set verify_token='$token' where Email='$get_email'";
        $update_token_run = mysqli_query($con, $update_token);
        if ($update_token_run) {
            send_password_reset($get_email,$token);
            $_SESSION['status'] = "Email sent to your registered emailid!";
           header("Location:login.php");
            
        } 
    }else {
        $_SESSION['statuss'] = "Please enter registered email address!";
        header("Location:login.php");
    }
}
?>
