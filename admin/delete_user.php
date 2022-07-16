<?php
require '../connection.php';
$uid=$_POST['uid'];
$q="delete from user where uid=$uid";
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