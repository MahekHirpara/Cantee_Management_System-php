<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("location:login.php");
}
?>
<?php
include "conn.php";
$start_date = date('Y-m-d', strtotime('-5 days'));
$end_date = date('Y-m-d');

$sql = "SELECT addedate ,COUNT(*) AS total_order from historyorder GROUP BY addedate";
$sql_run = mysqli_query($con, $sql);

$daily_order = array();

while ($row = mysqli_fetch_assoc($sql_run)) {
  $order_date = $row['addedate'];
  $order_total = $row['total_order'];

  $day = date('Y-m-d', strtotime($order_date));

  $daily_order[$day] = $order_total;
}

$all_dates = array();
$current_date = $start_date;

while ($current_date <= $end_date) {
  $all_dates[] = $current_date;
  $current_date = date('Y-m-d', strtotime($current_date . '+1 day'));
}

$daily_order_filled = array_fill_keys($all_dates, 0);
$daily_order_filled = array_merge($daily_order_filled, $daily_order);

ksort($daily_order_filled);

$daily_order_filled = array_slice($daily_order_filled, -6, null, true);

$day_lable = array_keys($daily_order_filled);
$order_data = array_values($daily_order_filled);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>canteen managment system</title>



  <!-- Site Icons -->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Day');
      data.addColumn('number', 'Order');
      data.addRows([
        <?php

        foreach ($daily_order_filled as $day => $orders) {
          echo "['" . $day . "', " . $orders . "],";
        }

        ?>
      ]);
      // var data = google.visualization.arrayToDataTable([
      //   ['day', 'order'],
      //   ['Sunday',  0, ],
      //   ['monday', 10, ],
      //   ['Tuesday',  20, ],
      //   ['Wenseday',  50,  ],
      //   ['Thrustday',  30, ],
      //   ['Friday', 100, ],
      //   ['Saturday',  20, ]
      // ]);

      var options = {
        title: 'Daily Order Data',
        curveType: 'function',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <?php
  include "conn.php";
  ?>
  <!--navbar-->
  <nav class="con navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <!--offcanvas trigger-->

      <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></i></span>
      </button>
      <!--offcanvas trigger-->
      <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">
        <img class="bg-image" src="image/logo2.png" alt="" width="50px" height="50px">
        <span class="px-2">Canteen VKM</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="color:white;">Logout</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php if (isset($_SESSION['email'])) {
                echo $_SESSION['email'];
              } ?><i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--navbar-->

  <!--offcanvas-->
  <div class="offcanvas offcanvas-start text-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <a href="#" class="nav-link px-3 active mt-2 pt-2">
              <span class="me-2">
                <i class="bi bi-speedometer2"></i>
              </span>
              <span>Dashbord</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a class="sidebar-link nav-link px-3 pt-2 text-white" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-menu-down"></i>
              </span>
              <span>Menu manage</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <div>
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="addmenu.php" class="nav-link px-5 text-white">
                      <span>Add new iteam</span>
                    </a>
                  </li>
                  <li>
                    <a href="ViewMenu.php" class="nav-link px-5 text-white">
                      <span>view iteam</span>
                    </a>
                  </li>
                  <li>
                    <a href="addcat.php" class="nav-link px-5 text-white">
                      <span>Add catagory</span>
                    </a>
                  </li>
                  <li>
                    <a href="ViewCategory.php" class="nav-link px-5 text-white">
                      <span>View catagory</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <a class="sidebar-link nav-link px-3 pt-2 text-white" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-menu-down"></i>
              </span>
              <span>Staff manage</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
            </a>
            <div class="collapse" id="collapseExample1">
              <div>
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="addstaff.php" class="nav-link px-5 text-white">
                      <span>Add Staff Detals</span>
                    </a>
                  </li>
                  <li>
                    <a href="Viewstaff.php" class="nav-link px-5 text-white">
                      <span>view Details</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <a href="ViewOrder.php" class="nav-link px-3 active mt-2">
              <span class="me-2">
                <i class="bi bi-journal-text"></i>
              </span>
              <span>View Order</span>
            </a>
          </li>
          <li>
            <a href="viewWishlist.php" class="nav-link px-3 active mt-2">
              <span class="me-2">
                <i class="bi bi-receipt-cutoff"></i>
              </span>
              <span>View Wishlist</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link px-3 active mt-2">
              <span class="me-2">
                <i class="bi bi-file-text"></i>
              </span>
              <span>View feedback</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!--offcanvas-->
  <!--containt-->
  <main class="mt-5 pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 fw-bold fs-3">
          Dashboard
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-3 mb-3">
          <div class="mcard card text-white text-end" style="height:8rem;">
            <div class="card-body">
              <p class="card-text ">
                <?php
                $sql = "select * from menutb";
                $result = mysqli_query($con, $sql);
                if ($total = mysqli_num_rows($result)) {
                ?>
              <h4 class="mb-0"><?php echo $total ?></h4>
            <?php
                } else {
            ?>
              <h4 class="mb-0"><?php echo "no data" ?></h4>
            <?php
                }
            ?>
            </p>
            <p> Total Iteam</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 mb-3">
          <div class="mcard card text-white mb-3 text-end" style="height:8rem;">
            <div class="card-body">
              <p class="card-text">
                <?php
                $sql = "select * from stafftb";
                $result = mysqli_query($con, $sql);
                if ($total = mysqli_num_rows($result)) {
                ?>
              <h4 class="mb-0"><?php echo $total ?></h4>
            <?php
                } else {
            ?>
              <h4 class="mb-0"><?php echo "no data" ?></h4>
            <?php
                }
            ?>
            </p>
            <p>Total Staff</p>
            </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 mb-3">
          <div class="mcard card text-white mb-3 text-end" style="height:8rem;">
            <div class="card-body">
              <p class="card-text">
                <?php
                $sql = "select * from ordertb";
                $result = mysqli_query($con, $sql);
                if ($total = mysqli_num_rows($result)) {
                ?>
              <h4 class="mb-0"><?php echo $total ?></h4>
            <?php
                } else {
            ?>
              <h4 class="mb-0"><?php echo "no data" ?></h4>
            <?php
                }
            ?>
            </p>
            <p>Total Order</p>
            </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 mb-3">
          <div class="mcard card text-white mb-3 text-end" style="height:8rem;">
            <div class="card-body">
              <p class="card-text">
                <?php
                $sql = "select * from ordertb where status=2";
                $result = mysqli_query($con, $sql);
                if ($total = mysqli_num_rows($result)) {
                ?>
              <h4 class="mb-0"><?php echo $total ?></h4>
            <?php
                } else {
            ?>
              <h4 class="mb-0"><?php echo "no data" ?></h4>
            <?php
                }
            ?>
            </p>
            <p>Active Order</p>
            </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card" style="width:750px; height: 500px">
            <div class="card-header">
              Charts
            </div>

            <div class="card-body" >
              <!-- <canvas class="chart" width="408" height="280"> -->
              <div id="curve_chart" style="width:700px; height: 350px"></div>
              <!-- </canvas> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--containt-->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

</body>

</html>