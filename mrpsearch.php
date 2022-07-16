<?php
require "connection.php";
$cname=$_POST['cname'];
$q="select * from stock where pid=$cname";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {
        echo $row['selling_price'];
    }
}

?>