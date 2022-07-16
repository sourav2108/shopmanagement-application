<?php
require '../connection.php';
$cid=$_POST['cid'];
$q="delete from category where cid=$cid";
$r=mysqli_query($conn,$q) or die("Query failed".mysqli_error($conn));
if($r)
{
    echo "Successfully Deleted";
}
else
{
    echo "Something went worng-".mysqli_error($conn);
}
?>