<?php
require_once '../vendor/autoload.php';
require "../connection.php";

$mpdf = new \Mpdf\Mpdf();
$fm=$_GET['fm'];
$to=$_GET['to'];
$data="";
$q1="select p.product_name,p.company_name,sum(s.quantity) as qnt,k.purches_price,s.selling_price FROM sales s,product p,stock k 
where p.pid=k.pid and p.pid=s.pid and date(s.created_timestamp) between '".$fm."' and '".$to."' group by p.product_name,p.company_name";
 $r=mysqli_query($conn,$q1) or die(mysqli_error($conn));
 $data .="<div style='text-align: center;'>
<h1>S K Enterprise</h1>
<h2>Profit/Loss Calculation Report</h2>
<h3>From  $fm To  $to</h3>
<hr>
</div>

<div>
<table style='margin: auto; text-align: center;'>
    <thead>
        <tr>
            <th style='padding-left: 20px; padding-right: 20px;'>Product Name</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Comapany Name</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Quantity</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Purches Price</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Selling Price</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Profit/Loss</th>
        </tr>
    </thead>
    <tbody>";
 if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {  
        $x=(($row['qnt']*$row['selling_price'])-($row['qnt']*$row['purches_price']));
       $data .= "<tr>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['product_name']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['company_name']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['qnt']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['purches_price']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['selling_price']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>$x</td>
           </tr><hr>";
    }
}
$data .="</tbody>
</table>
</div>";

$mpdf->WriteHTML($data);
$mpdf->Output();
?>