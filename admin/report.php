<?php
require_once "../header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Report Page</title>
</head>

<body>
    <div class="container-fluid bg-primary text-white">
        <marquee behavior="" direction="right">
            <h3>Show Report</h3>
        </marquee>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- admin menu -->
            <div class="col-lg-2 col-md-4">
                <div id="admin_menu">
                    <nav class="nav flex-column text-center ">
                        <a class="nav-link" href="../admin.php">Home</a>
                        <a class="nav-link" href="user.php">User</a>
                        <a class="nav-link" href="category.php">Category</a>
                        <a class="nav-link" href="product.php">Product</a>
                        <a class="nav-link " id="admin" href="report.php">Report</a>
                        <a class="nav-link " href="../logout.php">Logout</a>
                    </nav>
                </div>
            </div>
            <!-- admin body -->
            <div class="col-md-10">
                <div class="row mt-md-5" style="font-weight: bold;">
                    <div class="col-md-1 offset-md-1" >
                        <label for="form" class="form-label">Form</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="form" id="form">
                    </div>

                    <div class="col-md-1 offset-md-1">
                        <label for="to" class="form-label">To</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="to" id="to">
                    </div>
                </div>
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-2 offset-md-2" id="sales_report">
                        <a href="" class="btn btn-primary" id="sr">Sales Report</a>
                    </div>
                    <div class="col-md-2 offset-md-2" id="preport">
                        <a href="" class="btn btn-primary" id="pr">Purches Report</a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-2 offset-md-4" id="profit">
                        <a href="" class="btn btn-primary" id="pc">Profit Calculation</a>
                    </div>
                </div>
                <hr>
                <div class="row mt-md-5">
                    <div class="col-md-2 offset-md-4" id="st">
                        <a href="stock_check_report.php" class="btn btn-primary" id="stc">Stock Check</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.js"></script>

    <script>
        $(document).ready(function(){
            //for sales
            $("#sales_report").click(function(){
               let fm=$("#form").val();
               let to=$("#to").val();
               if(fm=="" || to=="")
               {
                  alert("Kindly Select From and To Date");
               }
               else
               {
                   $("#sr").attr('target', '_blank');
                   $("#sr").attr('href',"sales_report.php?fm="+fm+"&to="+to+"");
               }
               
            });
            //for purches
            $("#preport").click(function(){
               let fm=$("#form").val();
               let to=$("#to").val();
               if(fm=="" || to=="")
               {
                  alert("Kindly Select From and To Date");
               }
               else
               {
                   $("#pr").attr('target', '_blank');
                   $("#pr").attr('href',"purches_report.php?fm="+fm+"&to="+to+"");
               }
            });
            //for profit calculation
            $("#profit").click(function(){
               let fm=$("#form").val();
               let to=$("#to").val();
               if(fm=="" || to=="")
               {
                  alert("Kindly Select From and To Date");
               }
               else
               {
                   $("#pc").attr('target', '_blank');
                   $("#pc").attr('href',"profit_report.php?fm="+fm+"&to="+to+"");
               }
            });
            //stock check
            $("#st").click(function(){
                   $("#stc").attr('target', '_blank');
                   $("#stc").attr('href',"stock_check_report.php");
            });
        });
    </script>
</body>

</html>

