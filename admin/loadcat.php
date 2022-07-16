<?php
require "../connection.php";
$q="select * from category";
$val=" <option value=''>Select Category</option>";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    $val .=" <option value='all' selected>All</option>";
    while($row=mysqli_fetch_assoc($r))
    {
        $val.= " <option value='".$row['cid']."'>".$row['category_name']."</option>";
    }
    echo $val;
}
else
{
    echo $val;
}
?>