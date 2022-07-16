<?php
require '../connection.php';
$pid=$_POST['pid'];
$pname=ucfirst($_POST['pname']);
$cname=ucfirst($_POST['cname']);
$status=$_POST['status'];

$q="update product set product_name='".$pname."',company_name='".$cname."',status='".$status."',updated_timestamp=now() where pid=$pid";
$r=mysqli_query($conn,$q) or die("Query failed".mysqli_error($conn));
if($r)
{
    if($status=='inactive')
    {
        $q2="update stock set dml_status=2,updated_timestamp=now() where pid=$pid";
        $res=mysqli_query($conn,$q2);
        if($res)
        {
            echo "Successfully Update";
        }
        else
        {
            echo "Failed:  ".mysqli_error($conn);
        }
    }
    else
    {
        $q3="update stock set dml_status=0,updated_timestamp=now() where pid=$pid";
        $res1=mysqli_query($conn,$q3);
        if($res1)
        {
            echo "Successfully Update";
        }
        else
        {
            echo "Failed:  ".mysqli_error($conn);
        }
    }
}
else
{
    echo "Failed:  ".mysqli_error($conn);
}
?>