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
    <title>Home Page</title>
</head>

<body>
    <!-- header -->
    <div class="container bg-primary text-white text-center">
            <h3 class="p-3">Welcome To Home Page</h3>
    </div>
    <!-- Navbar -->
    <div class="container bg-success n">
        <nav class="nav justify-content-evenly">
            <a class="nav-link text-white b" aria-current="page" href="index.php">Home</a>
            <a class="nav-link text-white " href="bill.php">Bill Entry</a>
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
    <!-- Body start -->
    <div class="container x mb-1">
        <div class="row mb-5 mt-1">
            <label for="category" class="form-label col-md-2  offset-md-7 text-bold">Select Category</label>
            <div class="col-md-3">
                <select name="" id="category" class="form-select">
                </select>
            </div>
        </div>
        <div class="row">
            <label for="productname" class="col-md-2 col-form-label">Product Name</label>
            <div class="col-md-3">
                <input type="text" class="form-control" id="productname" autofocus>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary mb-1" id="product_search"><i class="fa-solid fa-magnifying-glass p-2"></i>Search</button>
            </div>
        </div>
    </div>

    <div class="container border border-info p-3 c">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-warning text-center">
                            <tr>
                                <th scope="col">Product Id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Selling Price</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider  text-center" id="tbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/load_cat.js"></script>
    <script>
        $(document).ready(function(){
             function p_search(pname,cat)
             {
                $.ajax({
                    url: 'psearch.php',
                    type: 'POST',
                    data: {productname:pname,category:cat},
                    success: function(data){
                       $('#tbody').html(data);
                    }
                });
             }

            $('#product_search').click(function(){
                let pname=$('#productname').val();
                let cat=$('#category').val();
                if(pname=="" || cat=="" )
                {
                    alert('Please enter a product name');
                }
                else
                {
                    p_search(pname,cat);
                }
                
            });

            // $('#productname').keyup(function(){
            //     let pname=$(this).val();
            //     let cat=$('#category').val();
            //     p_search(pname,cat);
            // });
        });
    </script>
</body>

</html>
