<?php
session_start();
require "connection.php";
$bn=$_POST['bn'];
$bd=$_POST['bd'];
$cn=ucfirst($_POST['cn']);
$cm=$_POST['cm'];
$ca=ucfirst($_POST['ca']);
$ta=$_POST['ta'];
$tpp=$_POST['tpp'];

$q="insert into bill_details(bill_no,bill_date,customer_name,customer_mobno,customer_address,
total_product_purches,total_amount,uid)
 values($bn,'".$bd."','".$cn."','".$cm."','".$ca."',$tpp,$ta,".$_SESSION['uid'].")";
 $r=mysqli_query($conn,$q);
 if($r)
 {
    echo 1;
 }
 else
 {
    echo "failed: ".mysqli_error($conn);
 }
?>