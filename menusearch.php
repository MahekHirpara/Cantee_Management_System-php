<?php
include 'conn.php';
$data = "select * from menutb where FoodName='" . $_POST['value'] . "' and CategoryId='".$_POST['mid']."'";
$res = mysqli_query($con, $data);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo'<div class="col-lg-4 col-sm-6">
        <div class="menu-item bg-white shadow-on-hover">
            <img src="admin/'.$row['Image'].'" alt="" height="200px" width="100%">
            <div class="menu-item-content p-4">
                <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b>'.$row['FoodName'].'</b></a></h5>
                <p class="small"><b>Price : </b>'.$row['Price'].'</p>
                <p class="small"><b>Discription :</b>'.$row['Discription'].'</p>
                <div class="addcart">
                    <button type="button" class="btn">Add to cart</button>
                    <div class="qty mt-3">
                        <button class="btn" style="font-size:14px;">
                            <span class="down mx-2"><strong>-</strong></span>
                            <input class="rounded mt-1 col-xs-2 " type="text" value="1" style="width:4vw; text-align:center; background: white; color: black">
                            <span class="up mx-2"><strong>+</strong></span>
                            <button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white">
                                <a class="like" style="font-size:25px">
                                    <i class="fa fa-heart"></i>
                                </a>
                                <a style="font-size:25px;text-decoration:none;">1</a>
                            </button>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
}
else{
    echo '<h5 class="text-center mt-5"> Iteam is not Avaliable</h5>';
}
?>
