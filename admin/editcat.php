<?php
session_start();
require '../connection.php';
$cid=$_POST['cedit'];
$cname=$_POST['cname'];

$q="update category set category_name='".$cname."',updated_timestamp=now(),uid=".$_SESSION['uid']." where cid=$cid";
$r=mysqli_query($conn,$q) or die("Query failed".mysqli_error($conn));
if($r)
{
    echo 1;
}
else
{
    echo "Query failed".mysqli_error($conn);
}
?>