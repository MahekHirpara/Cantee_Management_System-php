<?php
include "conn.php";
$start_date = date('Y-m-d',strtotime('-6 days'));
$end_date = date('Y-m-d');

$sql ="SELECT addedate ,COUNT(*) AS total_order from historyorder GROUP BY addedate";
$sql_run =mysqli_query($con,$sql);

$daily_order =array();

while($row = mysqli_fetch_assoc($sql_run)){
    $order_date =$row['addedate'];
    $order_total =$row['total_order'];

    $day = date('Y-m-d',strtotime($order_date));

    $daily_order[$day]=$order_total;
}

$all_dates=array();
$current_date =$start_date;

while($current_date <= $end_date){
    $all_dates[] = $current_date;
    $current_date =date('Y-m-d',strtotime($current_date.'+1 day'));
}

$daily_order_filled =array_fill_keys($all_dates,0);
$daily_order_filled = array_merge($daily_order_filled,$daily_order);

ksort($daily_order_filled);

$daily_order_filled = array_slice($daily_order_filled,-7,null,true);

$day_lable =array_keys($daily_order_filled);
$order_data =array_values($daily_order_filled);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string','Day');
        data.addColumn('number','Order');
        data.addRows([
           <?php
            
            foreach($daily_order_filled as $day=> $orders){
                echo "['".$day."', ".$orders."],";
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
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
<div id="curve_chart" style="width: 900px; height: 500px"></div>
</body>
</html>