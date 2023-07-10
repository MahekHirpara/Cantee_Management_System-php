<?php
include 'conn.php';
$data = "select * from menutb where FoodName='" . $_POST['value'] . "'";
$res = mysqli_query($con, $data);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo '<div class="col-lg-4 col-sm-6">
                                <div class="menu-item bg-white shadow-on-hover product_data">
                                    <img src="admin/' . $row['Image'] . '" alt="" height="200px" width="100%">
                                    <div class="menu-item-content p-4">
                                        <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b>Food Name : <b>' . $row['FoodName'] . '</b></a></h5>
                                        <p class="small"><b>Price : </b>' . $row['Price'] . '</p>
                                        <p class="small"><b>Discription :</b> ' . $row['Discription'] . '
                                        <div class="addcart">
                                            <div class="qty col-md-4 my-3">
                                                <div class="input-group mb-3" style="width:130px;">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                                    <button class="input-group-text increment-btn">+</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn addtocart" value="'. $row['MenuId'].'">Add to cart</button>
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
    ';
    }
}

?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="custome.js"></script>