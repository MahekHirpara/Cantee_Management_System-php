<?php
include 'conn.php';
if(isset($_GET['id']))
{
$Sid = $_GET['id'];
$del_category = "DELETE FROM `food_category` WHERE CategoryId = '$Sid'";
$result = mysqli_query($con,$del_category);
header("location:ViewCategory.php");
}
?>