<?php
require "connection.php";

$q="select sum(total_amount) as total from bill_details where extract(DAY from created_timestamp)=extract(DAY from sysdate())";
$r=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($r);
if($row['total']!=null)
{
    echo "Rs. ".$row['total'];
}
else
{
    echo "Rs. 0";
}

?>