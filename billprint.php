<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['uid'])) {
    header("location: login.html");
} else {
    $billno = $_GET['billno'];
    $b=0;
    require "connection.php";
    $q1 = "select * from bill_details where bill_no=$billno";
    $r1 = mysqli_query($conn, $q1);
    if (mysqli_num_rows($r1) > 0) 
    {
        $row1 = mysqli_fetch_assoc($r1);
    
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <title>Document</title>
            <style>
                div{
                    font-weight: bold;
                }
                span{
                    font-weight: 500;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col text-center bg-primary">
                        <h2>S K Enterprise</h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4 offset-1">Bill No: <span><?php echo $row1['bill_no']  ?></span> </div>
                    <div class="col-4 offset-3">Bill Date: <span><?php echo $row1['bill_date']  ?></span> </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4">Customer Name: <span><?php echo ucwords($row1['customer_name'])  ?></span></div>
                    <div class="col-4">Mobile No:<span> <?php echo $row1['customer_mobno']  ?></span></div>
                    <div class="col-4">Address: <span><?php echo $row1['customer_address']  ?></span></div>
                </div>
            <div class="row mt-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-secondary text-white text-center">
                            <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">MRP</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider text-center" id="tbody">
                            <?php
                            $q2 = "select * from sales s,product p where s.pid=p.pid and  s.bill_no=$billno";
                            $r2 = mysqli_query($conn, $q2);
                            if (mysqli_num_rows($r2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($r2)) {
                                    $b++;
                                    echo "<tr>
                                           <th scope='row'>$b</th>
                                           <td>" . $row2['product_name'] . "</td>
                                           <td>" . $row2['company_name'] . "</td>
                                           <td>".$row2['quantity']."</td>
                                           <td>".$row2['selling_price']."</td>
                                           <td>".$row2['total_amount']."</td>
                                        </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4 offset-8">Total Amount: <span><?php echo "   ".$row1['total_amount']  ?></span></div>
            </div>
            <!-- <div class="row">
                <div class="col-4 offset-8">Discount(in %): <span><?php echo "    ".$row1['discount']  ?></span></div>
            </div>
            <div class="row">
                <div class="col-4 offset-8">Total Paid Amount: <span><?php echo " ".$row1['total_paid_amount']  ?></span></div>
            </div> -->
            <div class="row mt-2">
                <div class="col"><span>Thank You. Visit Again....</span></div>
            </div>
            </div>
            <?php
                
              }
            ?>
            <script src="js/jquery.js"></script>
            <script>
               window.print();
               setTimeout(function(){
                window.close();
               },1000);
            </script>
        </body>

        </html>
    <?php
}
    ?>