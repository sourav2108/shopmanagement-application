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
    <title>Category Page</title>
</head>

<body>
    <div class="container-fluid bg-primary text-white text-center">
        <h3 class="p-3">Category Details</h3>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- admin menu -->
            <div class="col-lg-2 col-md-4">
                <div id="admin_menu">
                    <nav class="nav flex-column text-center ">
                        <a class="nav-link" href="../admin.php">Home</a>
                        <a class="nav-link" href="user.php">User</a>
                        <a class="nav-link" id="admin" href="category.php">Category</a>
                        <a class="nav-link" href="product.php">Product</a>
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
                                data-bs-target="#staticBackdrop">Add Category</button>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" id="categorysearch" placeholder="Search"
                                    aria-label="Search">
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-warning">
                                    <tr>
                                        <th scope="col">CID</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created_By</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="cattbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add category model -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Enter Category Details</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addcatform">
                        <label for="cname" class="form-label">Category Name</label>
                        <input type="text" name="cname" id="cname" class="form-control" autocomplete="off">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="newcatsave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit category model -->
    <div class="modal fade" id="edituser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ceditmodelbody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editcatsave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.cls', function () {
                $("#addcatform").trigger('reset');
            });

            function showcategory(n = null) {
                $.ajax({
                    url: 'showcategory.php',
                    type: 'POST',
                    data: { name: n },
                    success: function (data) {
                        $('#cattbody').html(data);
                    }
                });
            }
            showcategory();
            $("#categorysearch").keyup(function () {
                let name = $(this).val();
                showcategory(name);
            });

            $(document).on('click', '#newcatsave', function () {
                let nam = $("#cname").val();

                if (nam == "") {
                    alert("Please fill all field");
                }
                else {
                    $.ajax({
                        url: 'addcat.php',
                        type: 'POST',
                        data: { name: nam },
                        success: function (data) {
                            alert(data);
                            $("#addcatform").trigger('reset');
                            $(".cls").trigger("click");
                            showcategory();
                        }
                    });
                }
            });

            //  for edit model
            $(document).on('click', '#cedit', function () {
                let cid = $(this).data('cid');
                $.ajax({
                    url: 'showcat_for_edit.php',
                    type: 'POST',
                    data: { cid: cid },
                    success: function (data) {
                        $("#ceditmodelbody").html(data);
                    }
                });

            });

            $(document).on('click', '#delete', function () {
                if(confirm("Are you sure?"))
                {
                    let cid = $(this).data('cid');
                    $.ajax({
                        url: 'delete_cat.php',
                        type: 'POST',
                        data: { cid: cid },
                        success: function (data) {
                            alert(data);
                            showcategory();
                        }
                    });
                }

            });

            $(document).on('click', '#editcatsave', function () {
                let cnam = $("#cename").val();
                let cedit = $("#ceid").val();
                $.ajax({
                    url: 'editcat.php',
                    type: 'POST',
                    data: { cname: cnam, cedit: cedit },
                    success: function (data) {
                        if (data == 1) {
                            alert("Successfully Update");
                            $(".cls").trigger("click");
                            showcategory();
                        }
                        else {
                            alert(data);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
