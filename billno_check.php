<?php
require "connection.php";
$billno=$_POST['billno'];
$q="select * from bill_details where bill_no=$billno";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    echo 1;
}

?>