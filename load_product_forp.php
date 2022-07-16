<?php
require "connection.php";
$cid=$_POST['catname'];
$q1="select distinct(p.product_name) from product p, stock s where p.pid=s.pid and s.dml_status<>2";
$q2="select distinct(p.product_name) from product p,stock s,category c where 
p.pid=s.pid and p.cid=c.cid and c.cid=$cid and s.dml_status<>2";

$val="<option value=''>Select Product</option>";
if($cid=="")
{
  echo $val;
}
else
{
  if($cid=='all')
{
  $r=mysqli_query($conn,$q1);
  if(mysqli_num_rows($r)>0)
  {
    while($row=mysqli_fetch_assoc($r))
    {
        $val.= "<option value='".$row['product_name']."'>".$row['product_name']."</option>";
    }
    echo $val;
  }
  else
  {
    $val.= "<option value=''>No Product Found</option>";
    echo $val;
  }
}
else
{
  $r=mysqli_query($conn,$q2);
  if(mysqli_num_rows($r)>0)
  {
    while($row=mysqli_fetch_assoc($r))
    {
        $val.= "<option value='".$row['product_name']."'>".$row['product_name']."</option>";
    }
      echo $val;
  }
  else
  {
    $val.= "<option value=''>No Product Found</option>";
     echo $val;
  }
}
}

?>