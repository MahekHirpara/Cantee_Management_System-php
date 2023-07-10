<?php
include "header.php";
include "conn.php";
include "loginmodal.php";
include "singupmodal.php";
if (isset($_SESSION['uname'])) {
    $c_id = $_SESSION['cid'];
?>

    <section id="menu" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 intro-text">
                    <h1>Your Wishlist Iteams</h1>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row gy-4">
                <?php
                $data = "select w.*,m.FoodName,m.Image,m.Price,m.Discription from wishlist w, menutb m where m.MenuId=w.MenuId and CustomerId='$c_id'";
                $res = mysqli_query($con, $data);
                while ($row = mysqli_fetch_assoc($res)) {

                ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="menu-item bg-white shadow-on-hover product_data">
                            <?php $mid = $row['MenuId']; ?>
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
                                    $sql = "select * from wishlist where CustomerId= '$c_id' and MenuId='$mid'";
                                    $sql_run = mysqli_query($con, $sql);
                                    $flag = 0;
                                    if (mysqli_num_rows($sql_run) == 1) {
                                        $flag = 1;
                                        if ($flag == 1) {
                                            echo  '<button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white" value="' . $row['MenuId'] . '">
                                                     <a href="wishlist.php?mid=' . $row['MenuId'] . '" class="like heart" style="font-size:25px">
                                                         <i class="fa fa-heart"></i>
                                                     </a>
                                                 ';
                                            $sql_count = "SELECT COUNT(*) as count FROM `wishlist` where MenuId='$mid'";
                                            $sql_count_run = mysqli_query($con, $sql_count);
                                            if (mysqli_num_rows($sql_count_run) > 0) {
                                                $rowsql = mysqli_fetch_assoc($sql_count_run);
                                                $countrow = $rowsql['count'];
                                                echo '<a style="font-size:25px;text-decoration:none;">' . $countrow . '</a> </button>';
                                            }
                                        }
                                    } else {
                                        echo  '<button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white" value="' . $row['MenuId'] . '">
                                                <a href="wishlist.php?mid=' . $row['MenuId'] . '" class="like" style="font-size:25px">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            ';
                                        $sql_count1 = "SELECT COUNT(*) as count FROM `wishlist` where MenuId='$mid'";
                                        $sql_count_run1 = mysqli_query($con, $sql_count1);
                                        if (mysqli_num_rows($sql_count_run1) > 0) {
                                            $rowsql1 = mysqli_fetch_assoc($sql_count_run1);
                                            $countrow = $rowsql1['count'];
                                            echo '<a style="font-size:25px;text-decoration:none;">' . $countrow . '</a> </button>';
                                        }
                                    }


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php

} else {
    echo '<div class="container" style="min-height : 610px; margin-top:200px;">
    <div class="alert alert-info my-3">
        <font style="font-size:22px"><center> You need to <strong><a class="" data-bs-toggle="modal" data-bs-target="#login-modal">Login</a></strong> frist</center></font>
    </div></div>';
}

?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
 <script src="custome.js"></script>