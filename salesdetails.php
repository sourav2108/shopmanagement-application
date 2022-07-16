<?php
require "connection.php";
$bn=$_POST['billno'];
$cname=$_POST['cname'];
$qnt=$_POST['qnt'];
$mrp=$_POST['mrp'];
$total=$_POST['total'];
$sub;

$q="insert into sales(bill_no,pid,quantity,selling_price,total_amount)
 values($bn,$cname,$qnt,$mrp,$total)";

 $q2="select avl_quantity from stock where pid=$cname";

$res2=mysqli_query($conn,$q2);
if(mysqli_num_rows($res2)>0)
{
    $row=mysqli_fetch_assoc($res2);
    $sub=$row['avl_quantity']-$qnt;
}

$q3="update stock set avl_quantity=$sub where pid=$cname";
 $r=mysqli_query($conn,$q);
 if($r)
 {
    $res3=mysqli_query($conn,$q3) or die("failed: ".mysqli_error($conn));
    echo 1;
 }
 else
 {
    echo "failed: ".mysqli_error($conn);
 }
?>