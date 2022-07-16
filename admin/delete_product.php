<?php
require '../connection.php';
$pid=$_POST['pid'];
$q="delete from product where pid=$pid";
$q2="select avl_quantity from stock where pid=$pid";
$r2=mysqli_query($conn,$q2) or die("Query failed".mysqli_error($conn));
$result=mysqli_fetch_assoc($r2);
if($result['avl_quantity']!=0)
{
    echo "You can't delete this product because there some stock are availabel";
}
else
{
    $r=mysqli_query($conn,$q) or die("Query failed".mysqli_error($conn));
    if($r)
    {
        echo "Successfully Deleted";
    }
    else
    {
        echo "Failed:- ".mysqli_error($conn);
    }
}

?>