<?php

use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="row">

        <div class="col-lg-6 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Total Sales Per Month</h6>
                    <label><strong>Year:</strong></label>
                    <select name="cars" id="cars">
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                    </select>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="sales-month-table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Sales Amount</th>
                                <th>Total Sales Quantity</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ni utk letak kat controller -->
    <?php
    function getMonthlyEarning()
    {
        $query =  DB::select(DB::raw('SELECT 
        YEAR(TDATE) AS OrderYear,
        MONTH(TDATE) AS OrderMonthly,
        SUM(AMOUNT) AS TotalSales
        FROM kk_dwh.sales
        WHERE TDATE BETWEEN "2014-01-01" AND "2014-12-31"
        GROUP BY MONTH(TDATE),YEAR(TDATE)'));

        // ORIGINAL CODE

        // SELECT 
        //         YEAR(TDATE) AS OrderYear,
        //         MONTH(TDATE) AS OrderMonth,
        //         SUM(AMOUNT) AS TotalSales
        //         FROM kk_dwh.sales
        //         WHERE TDATE BETWEEN "2014-03-01" AND "2014-06-30"
        //         GROUP BY MONTH(TDATE),YEAR(TDATE)

        // CODE ORIGINAL SYAFIQ

        // DB::table("sales")
        // ->select(DB::raw("NVL(sum(amount), 0) amount"))
        // ->select(DB::select("select sum(AMOUNT) as TotalSales from sales where TDATE between ? and ?",['2014-01-01','2014-01-30']));
        // ->whereRaw("1=1");
        // ->whereRaw("TDATE between 2014-01-01 and 2014-01-30")
        // ->whereRaw('YEAR(created_at) == ? AND MONTH(created_at) == ?', [date('2014'),date('1')]);
        // ->select('amount');
        // ->first();

        // SECOND RUNNING CODE 

        // ->select(DB::select("select year(TDATE),month(TDATE),sum(AMOUNT) as TotalSales
        // from sales
        // where TDATE between ? and ?
        // group by year(TDATE),month(TDATE);"
        // ,['2014-01-01','2014-12-31']));

        // OTHER OPTION FOR RUNNING CODE

        // DB::select(DB::raw('SELECT 
        // YEAR(TDATE) AS OrderYear,
        // SUM(AMOUNT) AS TotalSales
        // FROM kk_dwh.sales
        // GROUP BY MONTH(TDATE),YEAR(TDATE)'));

        // TO CALCULATE FOR A MONTH ONLY

        // select sum(AMOUNT) from sales 
        // where TDATE between ? and ?,[,];


        $values = [];

        foreach ($query as $val) {

            array_push($values, (int)$val->TotalSales);
        }

        return $values;
    }

    $x = getMonthlyEarning();

    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <p> TESTING </p>
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
        // document.write(x);
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December'],
                datasets: [{
                    label: '# of Votes',
                    data: <?php echo json_encode($x); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>