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
    <title>User Page</title>
</head>

<body>
    <div class="container-fluid bg-primary text-white text-center">
        <h3 class="p-3">User Details</h3>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- admin menu -->
            <div class="col-lg-2 col-md-4">
                <div id="admin_menu">
                    <nav class="nav flex-column text-center ">
                        <a class="nav-link" href="../admin.php">Home</a>
                        <a class="nav-link" id="admin" href="user.php">User</a>
                        <a class="nav-link" href="category.php">Category</a>
                        <a class="nav-link" href="product.php">Product</a>
                        <a class="nav-link " href="report.php">Report</a>
                        <a class="nav-link " href="../logout.php">Logout</a>
                    </nav>
                </div>
            </div>
            <!-- admin body -->
            <div class="col-lg-10 col-md-6 mt-md-4">
                <div class="row mb-md-3">
                    <nav class="navbar bg-light">
                        <div class="container-fluid">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Add User</button>
                                <select name="status" id="status" class="border broder-primary">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" id="usersearch" type="search" placeholder="Search"
                                    aria-label="Search">
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-warning">
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Mobile No</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="usertbody">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add user model -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Enter User Details</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="adduserform">
                        <label for="fname" class="form-label">Full Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" autocomplete="off">
                        <label for="mob" class="form-label">Mobile No</label>
                        <input type="text" name="mob" id="mob" class="form-control" autocomplete="off">
                        <label for="addr" class="form-label">Address</label>
                        <input type="text" name="addr" id="addr" class="form-control" autocomplete="off">
                        <label for="uname" class="form-label">User Name</label>
                        <input type="text" name="uname" id="uname" class="form-control" autocomplete="off">
                        <select name="role" id="role" class="form-select mt-3 mb-3">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="newusersave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit model -->
    <div class="modal fade" id="edituser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  border-bottom border-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit User Details</h5>
                    <button type="button" class="btn-close btnc cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="uedit_modelbody">
                    <form action="" id="edituserform">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cls" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editusersave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            function showuser(n = null,st) {
                $.ajax({
                    url: 'usershow.php',
                    type: 'POST',
                    data: { name: n,st:st },
                    success: function (data) {
                        $('#usertbody').html(data);
                    }
                });
            }
            showuser(null,'active');
            $("#status").change(function(){
                let st=$(this).val();
                showuser(null,st);
            });

            $(document).on('click', '#newusersave', function () {
                let name = $("#fname").val();
                let mob = $("#mob").val();
                let addr = $("#addr").val();
                let uname = $("#uname").val();
                let role = $("#role").val();
                if (name == "" || mob == "" || addr == "" || uname == "" || role == "") {
                    alert("Please fill all field");
                }
                else {
                    if (mob.length == 10 && uname.length > 5) {
                        $.ajax({
                            url: 'adduser.php',
                            type: 'POST',
                            data: $("#adduserform").serialize(),
                            success: function (data) {
                                alert(data);
                                $("#adduserform").trigger('reset');
                                $(".cls").trigger("click");
                                showuser(null,'active');
                            }
                        });
                    }
                    else {
                        alert('Moibile no should be 10 digit and User name atleast 6 character');
                    }
                }
            });
            $(document).on('click', '.cls', function () {
                $("#adduserform").trigger('reset');
            });
            $("#usersearch").keyup(function () {
                let name = $(this).val();
                let status=$("#status").val();
                showuser(name,status);
            });

            //for edit user model
            $(document).on('click', '#uedit', function () {
                let uid = $(this).data('uid');

                $.ajax({
                    url: 'showuser_for_edit.php',
                    type: 'POST',
                    data: { uid: uid },
                    success: function (data) {
                        $("#edituserform").html(data);
                    }
                });

            });

            $(document).on('click', '#udelete', function () {
                if(confirm("Are you sure?"))
                {
                    let uid = $(this).data('uid');

                    $.ajax({
                        url: 'delete_user.php',
                        type: 'POST',
                        data: { uid: uid },
                        success: function (data) {
                            alert(data);
                            location.reload(true);
                        }
                    });
                }

            });

            $(document).on('click', '#editusersave', function () {
                let uid = $("#euid").val();
                let name = $("#efname").val();
                let mob = $("#emob").val();
                let addr = $("#eaddr").val();
                let role = $("#erole").val();
                let status=$("#st").val();
    
                if (name == "" || mob == "" || addr == "") {
                    alert("Please fill all field");
                }
                else {
                    if (mob.length == 10) {
                        $.ajax({
                            url: 'edituser.php',
                            type: 'POST',
                            data: { uid: uid, name: name, mob: mob, addr: addr, role: role, status: status },
                            success: function (data) {
                                alert(data);
                                $(".cls").trigger("click");
                                location.reload(true);
                            }
                        });
                    }
                    else {
                        alert('Moibile no should be 10 digit');
                    }
                }
            });
        });
    </script>
</body>

</html>
