<?php
require "connection.php";
$q2="select sum(total_amount) as total from sales where extract(YEAR from created_timestamp)=extract(YEAR from sysdate())";
$r2=mysqli_query($conn,$q2);
$t;
if(!is_null(mysqli_num_rows($r2)))
{
    $row=mysqli_fetch_assoc($r2);
    $t=$row['total'];
    
}
else
{
     $t=0;
}
echo "Rs. ".$t;


?>