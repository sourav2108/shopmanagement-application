<?php
require "connection.php";
$pname=$_POST['productname'];
$category=$_POST['category'];

if($category=='all')
{
  $q="select * from product p,stock s where p.pid=s.pid and p.product_name like'%".$pname."%' and s.dml_status<>2";
  $r=mysqli_query($conn,$q);
  if(mysqli_num_rows($r)>0)
  {
    while($row=mysqli_fetch_assoc($r))
    {
        echo "<tr>
        <th scope='row'>".$row['pid']."</th>
        <td>".$row['product_name']."</td>
        <td>".$row['company_name']."</td>
        <td>".$row['avl_quantity']."</td>
        <td>".$row['selling_price']."</td>
         </tr>";
    }
  }
  else
  {
    echo "<h4>No product found</h4>";
  }
}
else
{
  $q="select * from product p,stock s,category c where p.pid=s.pid and p.cid=c.cid and p.product_name like'%".$pname."%' and c.cid=$category and s.dml_status<>2";
  $r=mysqli_query($conn,$q);
  if(mysqli_num_rows($r)>0)
  {
    while($row=mysqli_fetch_assoc($r))
    {
        echo "<tr>
        <th scope='row'>".$row['pid']."</th>
        <td>".$row['product_name']."</td>
        <td>".$row['avl_quantity']."</td>
        <td>".$row['mrp']."</td>
         </tr>";
    }
  }
  else
  {
    echo "<h4>No product found</h4>";
  }
}

?>