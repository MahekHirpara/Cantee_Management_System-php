<?php
session_start();
include "conn.php";
include "_orderiteammodal.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Order</title>
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>
<div class="backtohome" style="margin-top :20px; margin-left:20px;">
        <button class="button rounded-circle" style="height:45px; width:45px; background-color:#953545; border:none">
            <a href="home.php" style="color:white; "><i class="bi bi-arrow-left"></i></a>
        </button>
    </div>
  <div class="container">
    <div class="row">
      <div class="table-wrapper" id="empty">
        <div class="table-title" style="margin-top:5px">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Order Details</h2>
            </div>
          </div>
        </div>
        <table class="table table-responsive table-striped">
          <thead>
            <tr>
              <th>Order Id</th>
              <th>Customer Name</th>
              <th>Order Type</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Items</th>
              <th>Comletion</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT o.*,r.Username,r.id FROM ordertb o,registation r where o.CustomerId=r.id ";
            $result = mysqli_query($con, $sql);
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              $orderId = $row['OrderId'];
              $custid = $row['Username'];
              $ordertypet = $row['OrderType'];
              $total_price = $row['total_amount'];
              $status = $row['status'];
            ?>
              <tr class="product_data">
                <td><?php echo $orderId ?></td>
                <td><?php echo $custid ?></td>
                <td><?php echo $ordertypet ?></td>
                <td><?php echo $total_price ?></td>
                <td>
                  <input type="hidden" class="prodId" value="<?php echo $orderId ?>">
                  <input type="hidden" class="cId" value="<?php echo $row['CustomerId']; ?>">
                  <select name="order_status" id="order_status" class="form-select order_status">
                    <option value="<?php echo $status ?>"><?php echo $status ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </td>
                <td><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#orderItem<?php echo $orderId ?>" style="background-color:#954535;">
                    <i class="bi bi-menu-button-wide" style="color:white;"></i>
                  </button></td>
                <td><button class="btn btn-primary"><a href="CompleteOrder.php?oid=<?php echo $orderId ?>" class="upd" style="text-decoration:none;color:white ;">Complete</a></button></td>
              </tr><?php
                  } ?>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.order_status').change(function() {
          var prodct_id = $(this).closest('.product_data').find('.prodId').val();
          var cust_id = $(this).closest('.product_data').find('.cId').val();
          var status = $(this).closest('.product_data').find('.order_status').val();

          $.ajax({
            url:'handlestatus.php',
            type: 'post',
            data:{
              'order_id': prodct_id,
              'customer_id': cust_id,
              'status': status,
              'scope1':'update',
            },
            success: function(response) {
              alert(response);
            }
          });
        });
      });
      setInterval(function(){
        location.reload();
      },3000);
    </script>
</body>

</html>