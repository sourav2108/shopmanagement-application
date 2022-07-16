<?php
session_start();
require "connection.php";
$cname=$_POST['cname'];
$qnt=$_POST['qnt'];
$mrp=$_POST['mrp'];
$prate=$_POST['prate'];
$total_prate=$_POST['total_prate'];
$pqnt=0;
$q1="select * from stock where pid=$cname";
$r1=mysqli_query($conn,$q1) or die("Failed: ".mysqli_error($conn));
if(mysqli_num_rows($r1)>0)
{
    $row=mysqli_fetch_assoc($r1);
    $pqnt=$row['avl_quantity']+$qnt;
    $q2="update stock set avl_quantity=$pqnt,selling_price=$mrp,purches_price=$prate,updated_timestamp=now() where pid=$cname";
    $r2=mysqli_query($conn,$q2) or die("Failed: ".mysqli_error($conn));
    
}
else
{
    $a="insert into stock(pid,avl_quantity,selling_price,purches_price) values($cname,$qnt,$mrp,$prate)";
    $s=mysqli_query($conn,$a)or die("Failed: ".mysqli_error($conn));
}

$q4="insert into purches(pid,quantity,selling_price,purches_price,uid) values($cname,$qnt,$mrp,$prate,".$_SESSION['uid'].")";



$r4=mysqli_query($conn,$q4) or die("Failed: ".mysqli_error($conn));
if(mysqli_affected_rows($conn)>0)
{
        echo 1;
}
else
{
    echo "Failed: ".mysqli_error($conn);
}

?>