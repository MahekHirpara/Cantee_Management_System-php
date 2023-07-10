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
    <div class="backtohome" style="margin-top :20px; margin-left:20px;">
        <button class="button rounded-circle" style="height:45px; width:45px; background-color:#953545; border:none">
            <a href="home.php" style="color:white; "><i class="bi bi-arrow-left"></i></a>
        </button>
    </div>
    <div class="container mt-5">
        <div class="header">
            <h2 class="text-center">Menu Iteam</h2>
        </div>
        <div class="body mt-5">
            <table  class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">DISCRIPTION</th>
                        <th scope="col">IMAGE</th>
                        <th scope="col">Category</th>
                        <th scope="col">Type</th>
                        <th scope="col">UPDATE</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'conn.php';
                    $view_menu = "select m.*,c.CategoryName from menutb m, food_category c where c.CategoryId =m.CategoryId order by MenuId";
                    $result = mysqli_query($con, $view_menu);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['MenuId']; ?></td>
                            <td><?php echo $row['FoodName']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><?php echo $row['Discription']; ?></td>
                            <td><img src="<?php echo $row['Image']; ?>" width="100px" height="100px"></td>
                            <td><?php echo $row['CategoryName']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><button class="btn btn-primary"><a href="updateMenu.php?id=<?php echo $row['MenuId']; ?>" class="upd" style="text-decoration:none;color:white ;">Edit</a></button></td>
                            <td><button class="btn btn-danger"><a href="deleteMenu.php?id=<?php echo $row['MenuId']; ?>" class="del" style="text-decoration:none;color:white ;">DELETE</a></button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</script>
</body>

</html>