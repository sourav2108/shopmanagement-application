<?php
require "connection.php";

$q="select count(*) as total from stock where avl_quantity<=5";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    $row=mysqli_fetch_assoc($r);
    echo  $row['total']." items";
}
else
{
    echo 0;
}

?>