<?php
session_start();
include "conn.php";

if (isset($_POST['submitbtn'])) {
    $email = $_POST['e-mail'];
   
    $sql = "SELECT * FROM `registation` WHERE Email='$email'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) === 1) {
        $row = mysqli_fetch_assoc($res);
        if ($row['Email'] === $email) {
             $_SESSION["e-mail"] = $row['Email'];
             $_SESSION["cid"] = $row['id'];
             $_SESSION["uname"] = $row['Username'];
            header("Location:index.php");
        }
    } else {
         echo '<script>alert("try again")</script>';
        // $error = '<div class="alert alert-danger" role="alert">
        //     plese enter register email and password
        //     </div>';
    }
}
?>

