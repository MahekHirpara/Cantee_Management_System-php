<?php
include "conn.php";
$itemModalSql = "SELECT * FROM `ordertb`";
$itemModalResult = mysqli_query($con, $itemModalSql);
while ($itemModalRow = mysqli_fetch_assoc($itemModalResult)) {
    $orderid = $itemModalRow['OrderId'];
?>
    <div class="modal fade" id="orderItem<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderItem<?php echo $orderid; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderItem<?php echo $orderid; ?>">Order Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table text">
                                    <thead>
                                        <tr>
                                        <th scope="col" class="border-0 bg-light">
                                                <div class="px-3">Id</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="px-3">Item</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="text-center">Quantity</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $mysql = "SELECT * FROM `orderiteam` WHERE OrderId = $orderid";
                                        $myresult = mysqli_query($con, $mysql);
                                        $counter=0;
                                        while ($myrow = mysqli_fetch_assoc($myresult)) {
                                            $orderId = $myrow['MenuId'];
                                            $Quantity = $myrow['itemquentity'];

                                            $itemsql = "SELECT * FROM `menutb` WHERE MenuId = $orderId";
                                            $itemresult = mysqli_query($con, $itemsql);
                                            $itemrow = mysqli_fetch_assoc($itemresult);
                                            $foodName = $itemrow['FoodName'];
                                            $Price = $itemrow['Price'];
                                            $img = $itemrow['Image'];
                                            $counter++;

                                            echo '<tr>
                                            <td class="align-middle text-start">'.$counter.'</td>
                                                <th scope="row">
                                                    <div class="p-2">
                                                    <img src="' . $img . '" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">' . $foodName . '</a></h5><span class="text-muted font-weight-normal font-italic d-block">Rs. ' . $Price . '/-</span>
                                                    </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle text-center"><strong>' . $Quantity . '</strong></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
}
?>