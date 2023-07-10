<?php
include "conn.php";
$id = $_GET['id'];
$qry = "select * from stafftb";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);
$staffname = $row['StaffName'];
$staffaddress = $row['StaffAddress'];
$staffsalary = $row['StaffSalary'];
$staffemail = $row['StaffEmail'];


if (isset($_POST['submit'])) {
    $staffname = $_POST['Name'];
    $staffaddress = $_POST['address'];
    $staffsalary = $_POST['salary'];
    $staffemail = $_POST['email'];

    $sql = "update stafftb set StaffName='{$staffname}',StaffAddress='{$staffaddress}',StaffSalary='{$staffsalary}',StaffEmail='{$staffemail}' where StaffId='{$id}'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        header("location:staff.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>canteen managment System</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <div class="Container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="box shadow bg-white p-4 rounded-2">
                    <h3 class="mb-3 text-center ps-3">Update staff</h3>
                    <form class="needs-validation mb-3" action="" enctype="multipart/form-data" method="post" novalidate>

                        <div class="mb-3">
                            <input type="text" name="Name" id="name" placeholder="Enter staff Name" class="form-control rounded-3" value="<?php echo $staffname ?>" required>

                        </div>
                        <div class="mb-3">
                            <input type="text" name="address" id="address" placeholder="Enter address " class="form-control rounded-3" value="<?php echo $staffaddress ?>" required>

                        </div>
                        <div class="mb-3">
                            <input type="text" name="salary" id="salary" placeholder="Enter salary" class="form-control rounded-3" value="<?php echo $staffsalary ?>" required>

                        </div>
                        <div class="mb-3">
                            <input type="text" name="email" id="email" placeholder="Enter email" class="form-control rounded-3" value="<?php echo $staffemail ?>" required>

                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="submit" class="btn border-0 rounded-3 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</body>


</html>