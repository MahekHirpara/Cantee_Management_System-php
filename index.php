<?php include "header.php";
include "conn.php";
include "singupmodal.php";
include "loginmodal.php";
?>
<div class="preloader">
    <img src="./image/logo.png" alt="">
</div>
<!--Slider-->
<div id="heroSlider" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $sql = "SELECT w.* ,COUNT(w.MenuId) AS count,m.Image from wishlist w, menutb m WHERE w.MenuId =m.MenuId GROUP BY w.MenuId ORDER BY count DESC LIMIT 3";
        $sql_run = mysqli_query($con, $sql);
        if (mysqli_num_rows($sql_run)) {
            while ($row = mysqli_fetch_assoc($sql_run)) {
                $image = $row['Image'];
        ?>
                <div class="carousel-item active">
                    <img src="admin/<?php echo $image?>" class="bg-image d-block w-100 " alt="...">
                </div>
                <!-- <div class="carousel-item">
                    <img src="image/slide1.jfif" class="bg-image d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="image/slide2.avif" class="bg-image d-block w-100" alt="...">
                </div> -->
        <?php
            }
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!--Slider-->
<!--menu-->
<section id="menu" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 intro-text">
                <h1>Explore Our Category</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 intro-text">
                <form class="d-flex mx-auto" method="post" id="let_search" action="menusearch.php" style="width:300px; height:20px; ">
                    <div class="input-group  my-lg-0">
                        <input type="text" name="search" id="str" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn" name="searchbtn" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-ctg" role="tabpanel" aria-labelledby="pills-ctg-tab" tabindex="0">

                <div class="row gy-4">
                    <?php
                    include 'conn.php';
                    $data = 'select * from food_category';
                    $res = mysqli_query($con, $data);
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="menu-item bg-white shadow-on-hover">
                                <img src="admin/<?php echo $row['image']; ?>" alt="" height="200px" width="100%">
                                <div class="menu-item-content p-4">
                                    <h5 class="mt-1 mb-2"><a href="#" style="text-decoration: none;color:black"><b></b><?php echo $row['CategoryName'] ?></a></h5>


                                    <div class="addcart">
                                        <button type="button" class="btn"><a href='menulist.php?id=<?php echo $row['CategoryId']; ?>' style="font-size:20px;text-decoration:none;color: white;">View All</a></button>
                                        <!-- <div class="qty mt-3">
                                            <button class="btn" style="font-size:14px;">
                                                <span class="down mx-2" onClick='decreaseCount(event, this)'><strong>-</strong></span>
                                                <input class="rounded mt-1 col-xs-2 " type="text" value="1" style="width:4vw; text-align:center; background: white; color: black">
                                                <span class="up mx-2" onClick='increaseCount(event, this)'><strong>+</strong></span>
                                                <button class="btn1 mx-4" style="border:none; text-decoration:none;background-color:white">
                                                    <a class="like" style="font-size:25px">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a style="font-size:25px;text-decoration:none;">1</a>
                                                </button>
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- search -->
        <div class="tab-pane fade show d-none" id="pills-search" role="tabpanel" aria-labelledby="pills-search-tab" tabindex="0">

            <div class="row gy-4">
                <?php
                include "search.php";
                ?>
            </div>
        </div>

    </div>
</section>

<!-- footer -->
<?php include "footer.php" ?>
<!-- footer -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
    $(window).on('load', function(){ 
        setTimeout(() => {
            $('.preloader').fadeOut( "slow", function() {
            $('body').css("overflow","scroll")
        });  
    }, 4000);
    });
    $(function() {
        $("#let_search").bind('submit', function() {
            var Value = $('#str').val();
            $.post('search.php', {
                value: Value
            }, function(data) {
                $("#pills-search").html(data);
            });
            return false;
        });
    });
    const searchbtn = document.querySelector('#button-addon2');
    const menuteam = document.querySelector('#pills-ctg');
    const searchmenu = document.querySelector('#pills-search');
    searchbtn.addEventListener('click', () => {
        menuteam.classList.remove('active');
        searchmenu.classList.add('active');
        searchmenu.classList.remove('d-none');
    });
</script>