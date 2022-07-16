<?php
session_start();
require "../connection.php";
$pname=ucfirst($_POST['pname']);
$pcname=ucfirst($_POST['pcname']);
$cname=ucfirst($_POST['category']);
$q2="select * from product where product_name='".$pname."' and company_name='".$pcname."'";
$n=mysqli_query($conn,$q2);
if(mysqli_num_rows($n)>0)
{
    echo "Product Already Exists";
}
else
{
    $q="insert into product(product_name,company_name,cid,uid) 
        values('".$pname."','".$pcname."',$cname,".$_SESSION['uid'].")";
       
    $res=mysqli_query($conn,$q);
    if($res)
    {
        $q3="select * from product where product_name='".$pname."' and company_name='".$pcname."'";
        $x=mysqli_query($conn,$q3);
        if(mysqli_num_rows($x)>0)
        {
            $s=mysqli_fetch_assoc($x);
            $q2="insert into stock(pid) values(".$s['pid'].")";
            $rr=mysqli_query($conn,$q2);
            echo "Succesfully Save";
        }
        else
        {
            echo "Failed: ".mysqli_error($conn);
        }
    }
    else
    {
        echo "Failed: ".mysqli_error($conn);
   }
}

?>