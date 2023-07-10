<?php
include 'conn.php';
if(isset($_GET['id']))
{
$Sid = $_GET['id'];
$del_staff = "DELETE FROM `stafftb` WHERE StaffId = '$Sid'";
$result = mysqli_query($con,$del_staff);
header("location:staff.php");
}
?>