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
    <title>Product Page</title>
</head>

<body>
    <div class="container-fluid bg-primary text-white text-center">
        <h3 class="p-3">Product Details</h3>
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
                        <a class="nav-link" id="admin" href="product.php">Product</a>
                        <a class="nav-link " href="report.php">Report</a>
                        <a class="nav-link " href="../logout.php">Logout</a>
                    </nav>
                </div>
            </div>
            <!-- admin body -->
            <div class="col-lg-10 col-sm-6 mt-4">
                <div class="row mb-3">
                    <nav class="navbar bg-light">
                        <div class="container-fluid">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Add Product</button>
                                <select name="status" id="status" class="border broder-primary">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" id="psearch" type="search" placeholder="Search"
                                    aria-label="Search">
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-warning text-center">
                                    <tr>
                                        <th scope="col">PID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider text-center" id="ptbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add product model -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Enter Product Details</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addproductform">
                        <label for="pname" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="pname" id="pname">
                        <label for="pcname" class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="pcname" id="pcname">
                        <label for="category" class="form-label">Category Name</label>
                        <select name="category" id="category" class="form-select mt-2">
                            
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="newpsave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit model -->
    <div class="modal fade" id="edituser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product details</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="pedit_modelbody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editproduct_save">Save</button>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            //load category
            function loadcat() {
            $.ajax({
                url: 'loadcat.php',
                type: 'POST',
                success: function (data) {
                     $('#category').append(data);
                  }
                });
               }
             loadcat();
            $(document).on('click', '.cls', function () {
                $("#addproductform").trigger('reset');
            });

            function showproduct(n = null,st) {
                $.ajax({
                    url: 'showproduct.php',
                    type: 'POST',
                    data: { name: n,status:st },
                    success: function (data) {
                        $('#ptbody').html(data);
                    }
                });
            }
            showproduct(null,'active');
            $("#status").change(function(){
                let st=$(this).val();
                showproduct(null,st);
            });
            $("#psearch").keyup(function () {
                let name = $(this).val();
                let status=$("#status").val();
                showproduct(name,status);
            });

            $(document).on('click', '#newpsave', function () {
                let pname = $("#pname").val();
                let pcname = $("#pcname").val();
                let cname = $("#category").val();
                if (pname == "" || pcname == "" || cname == "") {
                    alert("Please fill all field");
                }
                else {
                    $.ajax({
                        url: 'addproduct.php',
                        type: 'POST',
                        data: $("#addproductform").serialize(),
                        success: function (data) {
                            alert(data);
                            $("#addproductform").trigger('reset');
                            $(".cls").trigger("click");
                            showproduct(null,'active');
                        }
                    });
                }
            });

            // for edit product
            $(document).on('click', '#pedit', function () {
                let pid = $(this).data('pid');
                $.ajax({
                    url: 'showproduct_for_edit.php',
                    type: 'POST',
                    data: { pid: pid },
                    success: function (data) {
                        $("#pedit_modelbody").html(data);
                    }
                });

            });

            $(document).on('click', '#pdelete', function () {
                if(confirm("Are you sure?"))
                {
                    let pid = $(this).data('pid');
                $.ajax({
                    url: 'delete_product.php',
                    type: 'POST',
                    data: { pid: pid },
                    success: function (data) {
                        alert(data);
                        // showproduct(null,'active');
                        location.reload(true);
                    }
                });
                }

            });

            $(document).on('click', '#editproduct_save', function () {
                let epname = $("#epname").val();
                let ecname = $("#ecname").val();
                let epid = $("#epid").val();
                let estatus = $("#estatus").val();
                $.ajax({
                    url: 'editproduct.php',
                    type: 'POST',
                    data: { pid: epid, pname: epname, cname: ecname, status: estatus },
                    success: function (data) {
                        alert(data);
                        $(".cls").trigger("click");
                        // $("#status").val();
                        // showproduct(null,'active');
                        location.reload(true);
                    }
                });
            });
        });
    </script>
</body>

</html>
