<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Sneakslab Dashboard </title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
          <!-- Main Sidebar Container -->
           <?php echo view('sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Online Store Visitors</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4">
                                        <canvas id="visitors-chart" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This Week
                                        </span>

                                        <span>
                                            <i class="fas fa-square text-gray"></i> Last Week
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Orders</h3>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped table-valign-middle">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Orders</th>
                                                <th>Total Price</th>
                                                <th>Total Orders</th>
                                                <th>Total User</th>
                                                <th>Nama Item</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tableOrders['topOrdersWithItems'] as $order): ?>
                                                <tr>
                                                    <td><?= $order['order_date']?></td>
                                                    <td><?= $order['total_amount']?></td>
                                                    <td><?= $order['order_count'] ?></td>
                                                    <td><?= $order['user_count'] ?></td>
                                                    <td><?= $order['item_names'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Sales</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">Rp
                                                <?php echo $orders['sumAmount']; ?></span>
                                            <span>Sales Over Time</span>
                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success">
                                            </span>
                                            <span class="text-muted">Since last datetime</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->

                                    <div class="position-relative mb-4">
                                        <canvas id="sales-chart" height="200"></canvas>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                            <i class="fas fa-square text-primary"></i> This year
                                        </span>

                                        <span>
                                            <i class="fas fa-square text-gray"></i> Last year
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Online Store Overview</h3>

                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-danger text-xl">
                                            <ion-icon name="timer-outline"></ion-icon>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold">
                                                <?= $orders['orderCounts']['pending_orders'] ?>
                                            </span>
                                            <span class=" text-danger">PENDING ORDERS</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-primary text-xl">
                                            <ion-icon name="time-outline"></ion-icon>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold">
                                                <?= $orders['orderCounts']['in_progress_orders'] ?>
                                            </span>
                                            <span class="text-primary ">IN PROGRESS ORDERS</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->
                                    <div class="d-flex justify-content-between align-items-center mb-0">
                                        <p class="text-warning text-xl">
                                            <ion-icon name="cart-outline"></ion-icon>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold">
                                                <?= $orders['orderCounts']['total_orders'] ?>
                                            </span>
                                            <span class="text-warning">TOTAL ORDERS</span>
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-0">
                                        <p class="text-info text-xl">
                                            <ion-icon name="people-outline"></ion-icon>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold">
                                                <?php echo $orders['totalUsers'] ?>
                                            </span>
                                            <span class="text-info">TOTAL USERS</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>


        <!-- Main Footer -->
                  <?php echo view('footer'); ?>
    </div>
    <!-- ./wrapper -->


    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo base_url('assets') ?>/plugins/chart.js/Chart.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js"></script>

    <script>
        /* global Chart:false */

        $(function () {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_column($orders['topOrders'], 'order_date')); ?>,
                    datasets: [
                        {
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: <?php echo json_encode(array_column($orders['topOrders'], 'total_amount')); ?>
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function (value) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }

                                    return 'Rp ' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

            var $visitorsChart = $('#visitors-chart')
            // eslint-disable-next-line no-unused-vars
            var visitorsChart = new Chart($visitorsChart, {
                data: {
                    labels: <?php echo json_encode(array_column($orders['topOrders'], 'order_date')); ?>,
                    datasets: [{
                        type: 'line',
                        data: <?php echo json_encode(array_column($orders['topOrders'], 'user_count')); ?>,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        fill: false
                        // pointHoverBackgroundColor: '#007bff',
                        // pointHoverBorderColor    : '#007bff'
                    },
                    {
                        type: 'line',
                        data: <?php echo json_encode(array_column($orders['topOrders'], 'order_count')); ?>,
                        backgroundColor: 'tansparent',
                        borderColor: '#ced4da',
                        pointBorderColor: '#ced4da',
                        pointBackgroundColor: '#ced4da',
                        fill: false
                        // pointHoverBackgroundColor: '#ced4da',
                        // pointHoverBorderColor    : '#ced4da'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: 10
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })

        // lgtm [js/unused-local-variable]

    </script>
</body>

</html>