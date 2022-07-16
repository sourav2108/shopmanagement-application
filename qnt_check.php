<?php
require "connection.php";
$cname=$_POST['cname'];
$qnt=$_POST['qnt'];
$q="select * from stock where pid=$cname";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    $row=mysqli_fetch_assoc($r);
    if($qnt>$row['avl_quantity'])
    {
        // $x=array(1,$row['quantity']);
        // print_r($x);
        echo $row['avl_quantity'];
    }
    else
    {
        echo "<p style='color: green;' class='mb-0'>Stock Available</p>";
    }
}

?>