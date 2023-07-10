<?php
include "conn.php";
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
    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="table-wrapper" id="empty">
                <div class="table-title mt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-4">
                            <h2 class="text-center">Staff Details</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>E-mail</th>
                                    <th>Salary</th>
                                    <th>Profile</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'conn.php';
                                $view_staff = "select * from stafftb";
                                $result = mysqli_query($con, $view_staff);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['StaffId']; ?></td>
                                        <td><?php echo $row['StaffName']; ?></td>
                                        <td><?php echo $row['StaffAddress']; ?></td>
                                        <td><?php echo $row['StaffEmail']; ?></td>
                                        <td><?php echo $row['StaffSalary']; ?></td>
                                        <td><img src="<?php echo $row['Image']; ?>" width="100px" height="100px"></td>

                                        <td><button class="btn btn-primary"><a href="updatestaff.php?id=<?php echo $row['StaffId']; ?>" class="upd" style="text-decoration:none;color:white ;">Edit</a></button></td>
                                        <td><button class="btn btn-danger"><a href="deletestaff.php?id=<?php echo $row['StaffId']; ?>" class="del" style="text-decoration:none;color:white ;">DELETE</a></button></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>