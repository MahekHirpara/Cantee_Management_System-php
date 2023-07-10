<?php
session_start();
include "conn.php";
include "singupmodal.php";
include "loginmodal.php";
include "header.php";
$id = $_GET['id'];
$cid = $_SESSION['cid'];  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen managment</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
</head>

<body>

    <!--menu-->
    <section id="menu" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 intro-text">
                    <h1>Explore Our Menu</h1>
                </div>
            </div>
        </div>
        <div>
            <form class="d-flex mx-auto" method="post" id="lets_search" action="menusearch.php" style="width:300px; height:20px; margin-right:80px">
                <div class="input-group mb-5">
                    <input type="text" name="search" id="str" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn" name="searchbtn" type="submit" id="button-addon2" value="<?php echo $id ?>"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <div class="container mt-5">
            <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All Items</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-breakfast-tab" data-bs-toggle="pill" data-bs-target="#pills-breakfast" type="button" role="tab" aria-controls="pills-breakfast" aria-selected="true">Breakfast</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-lunch-tab" data-bs-toggle="pill" data-bs-target="#pills-lunch" type="button" role="tab" aria-controls="pills-lunch" aria-selected="true">Lunch</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-snack-tab" data-bs-toggle="pill" data-bs-target="#pills-snack" type="button" role="tab" aria-controls="pills-snack" aria-selected="true">Snack</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">

                    <div class="row gy-4">
                        <?php
                        include 'conn.php';
                        $data = "select * from menutb where CategoryId='$id'";
                        $res = mysqli_query($con, $data);
                        while ($row = mysqli_fetch_assoc($res)) {

                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="menu-item bg-white shadow-on-hover product_data">
                                    <?php $mid =$row['MenuId'];?>
                                    <img src="admin/<?php echo $row['Image']; ?>" alt="" height="200px" width="100%">
                                    <div class="menu-item-content p-4">
                                        <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b> <?php echo $row['FoodName'] ?></b></a></h5>
                                        <p class="small"><b>Price : </b><?php echo $row['Price'] ?></p>
                                        <p class="small"><b>Discription :</b> <?php echo $row['Discription'] ?>
                                        <div class="addcart">
                                            <div class="qty col-md-4 my-3">
                                                <div class="input-group mb-3" style="width:130px;">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                                    <button class="input-group-text increment-btn">+</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn addtocart" value="<?php echo $row['MenuId'] ?>">Add to cart</button>
                                             <?php 
                                             $sql ="select * from wishlist where CustomerId= '$cid' and MenuId='$mid'";
                                             $sql_run =mysqli_query($con,$sql);
                                             $flag=0;
                                             if(mysqli_num_rows($sql_run) == 1)
                                             {
                                                $flag = 1;
                                                if($flag == 1)
                                                {
                                                echo  '<button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white" value="'. $row['MenuId'] .'">
                                                     <a href="wishlist.php?mid='.$row['MenuId'].'" class="like heart" style="font-size:25px">
                                                         <i class="fa fa-heart"></i>
                                                     </a>
                                                 '; 
                                                  $sql_count = "SELECT COUNT(*) as count FROM `wishlist` where MenuId='$mid'";
                                                  $sql_count_run =mysqli_query($con,$sql_count);
                                                  if(mysqli_num_rows($sql_count_run) >0){
                                                    $rowsql = mysqli_fetch_assoc($sql_count_run);
                                                  $countrow =$rowsql['count'];
                                                  echo '<a style="font-size:25px;text-decoration:none;">'.$countrow.'</a> </button>';
                                                  }
                                                }
                                             }else{
                                                echo  '<button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white" value="'. $row['MenuId'] .'">
                                                <a href="wishlist.php?mid='.$row['MenuId'].'" class="like" style="font-size:25px">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            ';
                                            $sql_count1 = "SELECT COUNT(*) as count FROM `wishlist` where MenuId='$mid'";
                                                  $sql_count_run1 =mysqli_query($con,$sql_count1);
                                                  if(mysqli_num_rows($sql_count_run1) >0){
                                                    $rowsql1 = mysqli_fetch_assoc($sql_count_run1);
                                                  $countrow =$rowsql1['count'];
                                                  echo '<a style="font-size:25px;text-decoration:none;">'.$countrow.'</a> </button>';
                                                  }
                                                
                                             }
                                            
                                             
                                             ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <?php }?>
                    </div>
                </div>
                <div class="tab-pane fade show product-data" id="pills-breakfast" role="tabpanel" aria-labelledby="pills-breakfast-tab" tabindex="0">

                    <div class="row gy-4">
                        <?php
                        include 'conn.php';
                        $data = "select * from menutb where type='breakfast' and CategoryId='$id'";
                        $res = mysqli_query($con, $data);
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="menu-item bg-white shadow-on-hover product_data">
                                    <img src="admin/<?php echo $row['Image']; ?>" alt="" height="200px" width="100%">
                                    <div class="menu-item-content p-4">
                                        <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b>Food Name : </b><?php echo $row['FoodName'] ?></a></h5>
                                        <p class="small"><b>Price : </b><?php echo $row['Price'] ?></p>
                                        <p class="small"><b>Discription :</b> <?php echo $row['Discription'] ?>
                                        <div class="addcart">
                                            <div class="qty col-md-4 my-3">
                                                <div class="input-group mb-3" style="width:130px;">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                                    <button class="input-group-text increment-btn">+</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn addtocart" value="<?php echo $row['MenuId'] ?>">Add to cart</button>
                                            <button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white">
                                                <a class="like" style="font-size:25px">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a style="font-size:25px;text-decoration:none;">1</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-lunch" role="tabpanel" aria-labelledby="pills-lunch-tab" tabindex="0">

                    <div class="row gy-4">
                        <?php
                        include 'conn.php';
                        $data = "select * from menutb where type='lunch' and CategoryId='$id'";
                        $res = mysqli_query($con, $data);
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="menu-item bg-white shadow-on-hover product_data">
                                    <img src="admin/<?php echo $row['Image']; ?>" alt="" height="200px" width="100%">
                                    <div class="menu-item-content p-4">
                                        <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b>Food Name : </b><?php echo $row['FoodName'] ?></a></h5>
                                        <p class="small"><b>Price : </b><?php echo $row['Price'] ?></p>
                                        <p class="small"><b>Discription :</b> <?php echo $row['Discription'] ?>
                                        <div class="addcart">
                                            <div class="qty col-md-4 my-3">
                                                <div class="input-group mb-3" style="width:130px;">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                                    <button class="input-group-text increment-btn">+</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn addtocart" value="<?php echo $row['MenuId'] ?>">Add to cart</button>
                                            <button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white">
                                                <a class="like" style="font-size:25px">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a style="font-size:25px;text-decoration:none;">1</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-snack" role="tabpanel" aria-labelledby="pills-snack-tab" tabindex="0">

                    <div class="row gy-4">
                        <?php
                        include 'conn.php';
                        $data = "select * from menutb where type='snacks' and CategoryId='$id'";
                        $res = mysqli_query($con, $data);
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="menu-item bg-white shadow-on-hover product_data">
                                    <img src="admin/<?php echo $row['Image']; ?>" alt="" height="200px" width="100%">
                                    <div class="menu-item-content p-4">
                                        <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b>Food Name : </b><?php echo $row['FoodName'] ?></a></h5>
                                        <p class="small"><b>Price : </b><?php echo $row['Price'] ?></p>
                                        <p class="small"><b>Discription :</b> <?php echo $row['Discription'] ?>
                                        <div class="addcart">
                                            <div class="qty col-md-4 my-3">
                                                <div class="input-group mb-3" style="width:130px;">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                                    <button class="input-group-text increment-btn">+</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn addtocart" value="<?php echo $row['MenuId'] ?>">Add to cart</button>
                                            <button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white">
                                                <a class="like" style="font-size:25px">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a style="font-size:25px;text-decoration:none;">1</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- search -->
                <div class="tab-pane fade show d-none" id="pills-search" role="tabpanel" aria-labelledby="pills-search-tab" tabindex="0">

                    <div class="row gy-4">
                        <?php include "menusearch.php" ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--menu-->

    <!-- footer -->

    <?php include "footer.php" ?>
    <!-- footer -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="custome.js"></script>
    <script>
        //search
        const searchbtn = document.querySelector('#button-addon2');
        const menuteam = document.querySelector('#pills-all');
        const searchmenu = document.querySelector('#pills-search');
        searchbtn.addEventListener('click', () => {
            menuteam.classList.remove('active');
            searchmenu.classList.add('active');
            searchmenu.classList.remove('d-none');
        });

        $(function() {
            $("#lets_search").bind('submit', function() {
                var Value = $('#str').val();
                var id = $('#button-addon2').val();
                $.post('menusearch.php', {
                    value: Value,
                    mid: id
                }, function(data) {
                    $("#pills-search").html(data);
                });
                return false;
            });
        });
    </script>

</body>
</html>