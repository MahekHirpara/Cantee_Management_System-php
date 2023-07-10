<?php
include 'conn.php';
if(isset($_GET['id']))
{
$Sid = $_GET['id'];
$del_menu = "DELETE FROM `menutb` WHERE MenuId = '$Sid'";
$result = mysqli_query($con,$del_menu);
header("location:ViewMenu.php");
}
?>