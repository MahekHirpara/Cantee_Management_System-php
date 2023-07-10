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
                            <h2 class="text-center">Wishlist Details</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>CustomerId</th>
                                    <th>Menu ID</th>
                                    <th>Name</th>
                                    <th>Food Name</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'conn.php';
                                $count =0;
                                $view_staff = "select w.*,m.FoodName,r.Username,r.id from wishlist w,registation r,menutb m where m.MenuId=w.MenuId and r.id = w.CustomerID";
                                $result = mysqli_query($con, $view_staff);
                                while ($row = mysqli_fetch_array($result)) {
                                    $count++;
                                ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['MenuId']; ?></td>
                                        <td><?php echo $row['Username']; ?></td>
                                        <td><?php echo $row['FoodName']; ?></td>
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