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
    <title>Billing Page</title>
</head>

<body>
    <!-- header -->
    <!-- <div class="container bg-primary text-white text-center">
        <h3 class="p-2">Welcome To Billing Page</h3>
    </div> -->
    <!-- Navbar -->
    <div class="container bg-success n">
        <nav class="nav justify-content-evenly">
            <a class="nav-link text-white" aria-current="page" href="index.php">Home</a>
            <a class="nav-link text-white b" href="bill.php">Bill Entry</a>
            <a class="nav-link text-white " href="purches.php">Purches Entry</a>
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

    <!-- Customer Details -->
    <div class="container mt-1">
        <div class="row border border-info mb-1">
            <div class="col-md-12">
                <h5>Bill Details:</h5>
            </div>
            <label for="billno" class="col-md-1 offset-md-1 col-form-label">Bill No</label>
            <div class="col-md-2">
                <input type="text" class="form-control bordercolor mb-1" name="billno" id="billno" autofocus>
            </div>
            <label for="billdate" class="col-md-1 offset-md-3  col-form-label">Bill Date</label>
            <div class="col-md-2">
                <input type="date" class="form-control bordercolor mb-1" name="billdate" id="billdate">
            </div>
        </div>

        <div class="row border border-info">
            <div class="col-md-12">
                <h5>Customer Details:</h5>
            </div>
            <label for="cusname" class="col-md-2 col-form-label">Customer Name</label>
            <div class="col-md-2">
                <input type="text" class="form-control bordercolor" name="cusname" id="cusname">
            </div>
            <label for="cusmob" class="col-md-2  col-form-label">Mobile No</label>
            <div class="col-md-2">
                <input type="text" class="form-control bordercolor" name="cusmob" id="cusmob">
            </div>
            <label for="cusaddr" class="col-md-1 col-form-label">Address</label>
            <div class="col-md-3 mt-1">
                <input type="text" class="form-control bordercolor mb-1" name="cusaddr" id="cusaddr">
            </div>
        </div>
        <!-- Product details -->
        <div class="row border border-bottom-0 border-top-0 border-primary">
            <div class="col-md-12">
                <h5>Product Details:</h5>
            </div>
        </div>
        <form class="row border border-top-0 border-primary" id="pform">
            <div class="col-md-2">
                <label for="category" class="form-label">Category Name</label>
                <select name="category" id="category" class="form-select mb-1">

                </select>
            </div>
            <div class="col-md-2">
                <label for="pname" class="form-label">Product Name</label>
                <select name="pname" id="pname" class="form-select mb-1">
                    
                </select>
            </div>
            <div class="col-md-2">
                <label for="csearch" class="form-label">Company Name</label>
                <select name="csearch" id="csearch" class="form-select mb-1">

                </select>
            </div>
            <div class="col-md">
                <label for="mrp" class="form-label">Selling Price</label>
                <input type="text" class="form-control bordercolor mb-1" name="mrp" id="mrp" disabled>
            </div>
            <div class="col-md">
                <label for="pq" class="form-label">Quantity</label>
                <input type="number" class="form-control bordercolor mb-1" name="pq" id="pq"><span id="qspan"></span>
            </div>
            <div class="col-md">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control mb-1 bordercolor" name="total" value="0" id="total" disabled>
            </div>
            <div class="col-md-1">
                <label for="total" class="form-label" style="visibility: hidden;">Total</label>
                <button class="btn btn-primary" id="addproduct"><i class="fa-solid fa-plus"></i></button>
            </div>
        </form>
    </div>

    <!-- Total item -->
    <div class="container billdetails">
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-secondary text-white text-center">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Selling_price</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center" id="tbody">

                </tbody>
            </table>
        </div>
    </div>

    <!-- final section -->
    <div class="container">
        <div class="row border border-success mt-2"">
            <div class=" col-md-3 offset-md-4">
            <label for="totalamount">Total Amount</label>
            <input type="text" value="0" class="form-control bordercolor mb-1" name="totalamount" id="totalamount"
                disabled>
        </div>
        <!-- <div class="col">
            <label for="discount">Discount</label>
            <div class="input-group">
                <input type="text" class="form-control bordercolor mb-1" value="0" name="discount" id="discount">
                <span class="input-group-text" id="basic-addon1">%</span>
            </div>
        </div>
        <div class="col">
            <label for="paidamount">Paid Amount</label>
            <input type="text" value="0" class="form-control bordercolor mb-1" name="paidamount" id="paidamount"
                disabled>
        </div> -->
    </div>
    <div class="row mt-2">
        <div class="col-md-1 offset-md-4">
            <button class="btn btn-success" id="save">Save</button>
        </div>
        <div class="col-md-1" id="print">
            <!-- <button class="btn btn-info" id="print">Print</button> -->
            <!-- <button class="btn btn-info" id="print">Print</button> -->
            <a href="" class="btn btn-info"  id="plink">Print</a>
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger" id="reset">Reset</button>
        </div>
    </div>
    </div>

    <script>
        
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/load_cat.js"></script>
    <script>
        $(document).ready(function () {
            let counter = 0;
            let totalamount = 0;
            let x = [];
            let totalproduct = 0;
            let c="";
            function showcompany(cname)
            {
                $.ajax({
                    url: 'showcompany.php',
                    type: 'POST',
                    data: {cname: cname },
                    success: function (data) {
                        c=data;
                    }
                });   
            }
            $('#csearch').change(function () {
                let cname = $(this).val();
                showcompany(cname);
                $.ajax({
                    url: 'mrpsearch.php',
                    type: 'POST',
                    data: {cname: cname },
                    success: function (data) {
                        $('#mrp').val(data);
                        let pq = $("#pq").val();
                        let total = data * pq;
                        $("#total").val(total);
                    }
                });
            });
            //print
            $("#print").click(function(){
                let bill=$("#billno").val();
                $("#plink").attr('target', '_blank');
                $("#plink").attr('href', "billprint.php?billno="+bill+"");
                // location="billprint.php?billno="+bill+"";
            });
            //reset page
            $("#reset").click(function () {
                location.reload(true);
            });

            $("#pq").keyup(function () {
                let qval = $(this).val();
                let cname = $("#csearch").val();
                let mrp = $('#mrp').val();
                let total = qval * mrp;
                $.ajax({
                    url: 'qnt_check.php',
                    type: 'POST',
                    data: {cname: cname, qnt: qval },
                    success: function (data) {
                        if (!isNaN(data)) {
                            $("#qspan").html("<p style='color: red;' class='mb-0'>Available Stock: " + data + "</p>");
                            $("#addproduct").attr("disabled", true);
                        }
                        else {
                            $("#qspan").html(data);
                            $("#addproduct").attr("disabled", false);
                            $("#total").val(total);
                        }
                    }
                });

            });

            $("#addproduct").click(function (e) {
                e.preventDefault();
                counter++;
                totalproduct++;
                let pname = $("#pname").val();
                let cname = $("#csearch").val();
                let mrp = $("#mrp").val();
                let quantity = $("#pq").val();
                let total = $("#total").val();
                let val = "<tr class='itemrow'> <th scope='row'>" + counter + "</th><td class='p'>" + pname + "</td><td>" + c + "</td><<td>" + quantity + "</td><td>" + mrp + "</td><td class='t'>" + total + "</td><td  data-sl='" + counter + "' class='d' style='cursor: pointer;'><i class='fa-solid fa-trash-can text-danger'></i></td></tr>";
                $('#tbody').append(val);
                totalamount += parseInt(total);
                // let dis = $("#discount").val();
                // let pamt = totalamount - (totalamount * (dis / 100));
                $('#totalamount').val(totalamount);
                let v = [cname, quantity, mrp,total];
                x[counter] = v;
                $("#pname").val("");
                $("#csearch").val("");
                $("#mrp").val("");
                $("#pq").val("");
                $("#total").val("0");
            });

            //for delete item
            $(document).on('click', '.d', function () {
                let index = $(this).data('sl');
                x.splice(index, 1);
                $(this).closest("tr").fadeOut();
                let value = $(this).siblings(".t").html();
                let tmt = $("#totalamount").val();
                let pmt = $("#paidamount").val();
                tmt -= parseInt(value);
                let dis = $("#discount").val();
                let y = tmt - (tmt * (dis / 100));
                $("#totalamount").val(tmt);
                $("#paidamount").val(y);
                totalproduct--;
            });

            $("#discount").keyup(function () {
                let dis = $(this).val();
                let tmt = $('#totalamount').val();
                let total = tmt - (tmt * (dis / 100));
                $("#paidamount").val(total);
            });
            
            //load by default product
            function loadproduct(cat) {
        $.ajax({
            url: 'loadproduct.php',
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

            //load product
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
                        $('#csearch').html(data);
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
            }, 800);


            //sales information store
            function insertsales(ar, bn) {
                let cname = ar[0];
                let qnt = ar[1];
                let mrp = ar[2];
                let total = ar[3];
                $.ajax({
                    url: 'salesdetails.php',
                    type: 'POST',
                    data: { billno: bn, cname: cname, qnt: qnt, mrp: mrp, total:total},
                    success: function (data) {
                        if (data == 1) {
                            // alert("save successful");
                        }
                        else {
                            alert(data);
                        }
                    }
                });
            }

            $("#save").click(function () {
                let billno = $("#billno").val();
                let billdate = $("#billdate").val();
                let customer_name = $("#cusname").val();
                let customer_mobno = $("#cusmob").val();
                let customer_address = $("#cusaddr").val();
                let totalamt = $("#totalamount").val();
                // let totalpaidamt = $("#paidamount").val();
                // let discount = $("#discount").val();

                if (billno == "" || billdate == "" || customer_name == "" || customer_mobno == "" || customer_address == "" || totalproduct == 0) {
                    alert("Please fill all field");
                }
                else {
                    $.ajax({
                        url: 'billdetails.php',
                        type: 'POST',
                        data: { bn: billno, bd: billdate, cn: customer_name, cm: customer_mobno, ca: customer_address, ta: totalamt, tpp: totalproduct },
                        success: function (data) {
                            if (data == 1) {
                                alert("save successful");
                                x.forEach(function (e, i, a) {
                                    insertsales(e, billno);
                                });
                            }
                            else {
                                alert(data);
                            }
                        }
                    });
                }
            });

            //checking bill no
            $("#billno").focusout(function () {
                let billno = $("#billno").val();
                $.ajax({
                    url: 'billno_check.php',
                    type: 'POST',
                    data: { billno: billno },
                    success: function (data) {
                        if (data == 1) {
                            alert("Bill No already Exist. Try with another");
                            $("#save").attr('disabled', true);
                        }
                        else {
                            $("#save").attr('disabled', false);
                        }
                    }
                });
            });
            //mobile no checking
            $("#cusmob").focusout(function () {
                let mn = $(this).val();
                var patt = /[0-9]{10}/g;
                if (!patt.test(mn)) {
                    alert("Only 10 digit No is allow");
                    $("#save").attr('disabled', true);
                }
                else {
                    $("#save").attr('disabled', false);
                }
            });
        });
    </script>
</body>

</html>
