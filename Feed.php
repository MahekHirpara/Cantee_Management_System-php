<?php
session_start();
include "conn.php";
$cid =$_SESSION['cid'];
if(isset($_POST['send'])){
    $feedback=$_POST["feedback"];
    $sql="insert into `feedbacktb` (`CustomerId`,`Review`) values('$cid','$feedback')";
    $sqres=mysqli_query($con,$sql);
    if($sqres)
    {
        header("Location:index.php");
    }

}
?>