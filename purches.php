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
    <link rel="stylesheet" href="css/index.css">
    <title>Purches Entry Page</title>
</head>

<body>
    <!-- header -->
    <div class="container bg-primary text-white text-center">
        <h3 class="p-3">Welcome To Purches Entry Page</h3>
    </div>
    <!-- Navbar -->
    <div class="container bg-success n">
        <nav class="nav justify-content-evenly">
            <a class="nav-link text-white " aria-current="page" href="index.php">Home</a>
            <a class="nav-link text-white " href="bill.php">Bill Entry</a>
            <a class="nav-link text-white b" href="purches.php">Purches Entry</a>
            <?php  
             if($_SESSION['role']=='admin')
             {?>
                <a class="nav-link text-white " href="admin.php">Admin</a>
             <?php   
             }
            ?>
            <a class="nav-link text-white " href="logout.php">Logout</a>
        </nav>
    </div>
    <!-- Body start -->
    <div class="container border border-primary mt-3" id="bc">
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h3>Enter Purches Details</h3>
            </div>
            <form action="" class="row m-3" id="pform">
                <div class="col-md-3 offset-md-1 mt-3">
                    <label for="category" class="form-label">Category Name</label>
                    <select class="form-select bordercolor" name="category" id="category">

                    </select>
                </div>
                <div class="col-md-3 offset-md-1 mt-3">
                    <label for="pname" class="form-label">Product Name</label>
                    <select class="form-select bordercolor" name="pname" id="pname">

                    </select>
                </div>
                <div class="col-md-3 offset-md-1 mt-3">
                    <label for="cname" class="form-label">Company Name</label>
                    <select class="form-select bordercolor" name="cname" id="cname">

                    </select>
                </div>
                <div class="col-md-3 offset-md-1 mt-5">
                    <label for="qnt" class="form-label">Quantity</label>
                    <input type="number" class="form-control bordercolor" value="1" name="qnt" id="qnt">
                </div>
                <div class="col-md-3 offset-md-1 mt-5">
                    <label for="mrp" class="form-label">Selling Price</label>
                    <input type="number" class="form-control bordercolor" name="mrp" id="mrp">
                </div>
                <div class="col-md-3 offset-md-1 mt-5">
                    <label for="prate" class="form-label">Purches Price</label>
                    <input type="number" class="form-control bordercolor" value="1" name="prate" id="prate">
                </div>
                <div class="col-md-3 offset-md-5 mt-5">
                    <label for="total_prate" class="form-label">Total Purches Amont</label>
                    <input type="text" class="form-control bordercolor" value="1" name="total_prate" id="total_prate"
                        disabled>
                </div>
            </form>
            <div class="row mt-4 mb-3">
                <div class="col-md-1 offset-sm-5">
                    <button class="btn btn-outline-success text-dark" id="save">Save</button>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-outline-danger text-dark" id="r">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/load_cat.js"></script>
    <script>
        $(document).ready(function () {

            function settotal(qnt, prate) {
                $("#total_prate").val(qnt * prate);
            }

            $("#qnt").keyup(function () {
                let qnt = $(this).val();
                let prate = $("#prate").val();
                settotal(qnt, prate);
            });
            $("#prate").keyup(function () {
                let prate = $(this).val();
                let qnt = $("#qnt").val();
                settotal(qnt, prate);
            });

            $("#r").click(function () {
                $("#pform").trigger('reset');
            });
            $("#save").click(function () {
                let pname = $("#pname").val();
                let cname = $("#cname").val();
                let mrp = $("#mrp").val();
                let p = $("#total_prate").val();
                let qnt = $("#qnt").val();
                let prate = $("#prate").val();
                if (pname == "" || cname == "" || mrp == "") {
                    alert("Please fill all field");
                }
                else {
                    $.ajax({
                        url: 'purchesdetails.php',
                        type: 'POST',
                        data: {cname: cname, qnt: qnt, mrp: mrp, prate: prate, total_prate: p },
                        success: function (data) {
                            if (data == 1) {
                                alert("Successfully save");
                                $("#pform").trigger('reset');

                            }
                            else {
                                alert(data);
                            }
                        }
                    });
                }
            });

            //load product
            function loadproduct(cat) {
                $.ajax({
                    url: 'load_product_forp.php',
                    type: 'POST',
                    data: { catname: cat },
                    success: function (data) {
                        $('#pname').html(data);
                    }
            });
            }
            setTimeout(function () {
                let catname = $("#category").val();
                loadproduct(catname);
            }, 500);

            $("#category").change(function () {
                let x = $(this).val();
                loadproduct(x);
            });
            //load company
            function loadcompany(pname)
            {
                $.ajax({
                    url: 'loadcompany.php',
                    type: 'POST',
                    data: { pname: pname },
                    success: function (data) {
                        $('#cname').html(data);
                    }
                });
            }
            $('#pname').change(function () {
                let pname = $(this).val();
                loadcompany(pname);
            });
            setTimeout(function () {
                let pname = $("#pname").val();
                loadcompany(pname);
            }, 500);

        });
    </script>

</body>

</html>
