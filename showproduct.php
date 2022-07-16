<?php
require "connection.php";

$q="select count(*) as total from product";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    $row=mysqli_fetch_assoc($r);
    echo $row['total'];
}
else
{
    echo 0;
}

?>