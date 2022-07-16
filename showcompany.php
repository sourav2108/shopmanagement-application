<?php
require "connection.php";
$pid=$_POST['cname'];
$q="select * from product where pid=$pid";
$r=mysqli_query($conn,$q) or die(mysqli_error($conn));
if(mysqli_num_rows($r)>0)
{
    $row=mysqli_fetch_assoc($r);
    echo $row['company_name'];
}
?>