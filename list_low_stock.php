<?php
require "connection.php";

$q="select * from product p,stock s where p.pid=s.pid and s.avl_quantity<=5";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
   while($row=mysqli_fetch_assoc($r))
   {
    echo "<tr>
        <th scope='row'>".$row['product_name']."</th>
        <td>".$row['company_name']."</td>
        <td>".$row['avl_quantity']."</td>
         </tr>";
   }
}
else
{
    echo "No product found";
}

?>