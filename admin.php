<?php
require_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Admin Page</title>

</head>

<body>
    <!-- header -->
    <div class="container-fluid bg-primary text-white text-center">
        <h3 class="p-3">WELCOME To Admin Page</h3>
    </div>
    <!-- Navbar -->
    <div class="container-fluid bg-success n">
        <nav class="nav justify-content-evenly">
            <a class="nav-link text-white" aria-current="page" href="index.php">Home</a>
            <a class="nav-link text-white" href="bill.php">Bill Entry</a>
            <a class="nav-link text-white " href="purches.php">Purches Entry</a>
            <a class="nav-link text-white b" href="admin.php">Admin</a>
        </nav>
    </div>



    <div class="container-fluid">
        <div class="row">
            <!-- admin menu -->
            <div class="col-md-2">
                <div id="admin_menu">
                    <nav class="nav flex-column text-center ">
                        <a class="nav-link" id="admin" href="admin.php">Home</a>
                        <a class="nav-link" href="admin/user.php">User</a>
                        <a class="nav-link" href="admin/category.php">Category</a>
                        <a class="nav-link" href="admin/product.php">Product</a>
                        <a class="nav-link " href="admin/report.php">Report</a>
                        <a class="nav-link " href="logout.php">Logout</a>
                    </nav>
                </div>
            </div>
            <!-- admin body -->
            <div class="col-md-10 text-center" style="background-color: LightBlue;">
                <div class="row mt-md-5">
                    <div class="col-md-2 offset-md-1">
                        <div class="card" style="background-color: teal;">
                            <div class="card-body text-white">
                                <h5 class="card-title ">Total Product</h5>
                                <h4 class="card-text text-center" id="total_product">0</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1">
                        <div class="card" style="background-color: springgreen;">
                            <div class="card-body">
                                <h5 class="card-title">Total Sales Today</h5>
                                <h4 class="card-text text-center" id="total_sales">0</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 offset-md-1">
                        <div class="card" style="background-color: orangered;">
                            <div class="card-body">
                                <h5 class="card-title">Low Stocks</h5>
                                <h4 class="card-text text-center" id="low_stock">0</h4>
                                <button class="btn btn-primary" id="list_low-stock" data-bs-toggle='modal'
                                    data-bs-target='#lowstock'><i class="fa-solid fa-list"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-md-5">
                        <div class="col-md-2 offset-md-4">
                            <div class="card" style="background-color: DodgerBlue;">
                                <div class="card-body text-white">
                                    <h5 class="card-title">Total Revenue</h5>
                                    <h4 class="card-text text-center" id="profit">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- low stock model -->
    <div class="modal fade" id="lowstock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">List Of Low Stock Product</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-secondary text-white text-center">
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center" id="lowstockmodel">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editcatsave">Save</button>
                </div>
            </div>
        </div>
    </div>



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            //show total product
            function show_total_product() {
                $.ajax({
                    url: 'showproduct.php',
                    type: 'POST',
                    success: function (data) {
                        $('#total_product').html(data);
                    }
                });
            }
            show_total_product();

            //total sales today
            function total_sales_today() {
                $.ajax({
                    url: 'showtotalsales.php',
                    type: 'POST',
                    success: function (data) {
                        $('#total_sales').html(data);
                    }
                });
            }
            total_sales_today();

            //low stock
            function low_stock() {
                $.ajax({
                    url: 'show_low_stock.php',
                    type: 'POST',
                    success: function (data) {
                        $('#low_stock').html(data);
                    }
                });
            }
            low_stock();

            $("#list_low-stock").click(function () {
                $.ajax({
                    url: 'list_low_stock.php',
                    type: 'POST',
                    success: function (data) {
                        $('#lowstockmodel').html(data);
                    }
                });
            });

            //profit
            function revenue() {
                $.ajax({
                    url: 'profit.php',
                    type: 'POST',
                    success: function (data) {
                        $('#profit').html(data);
                    }
                });
            }
            revenue();
        });
    </script>
</body>

</html>
