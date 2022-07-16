<?php
require_once '../vendor/autoload.php';
require "../connection.php";

$mpdf = new \Mpdf\Mpdf();
$fm=$_GET['fm'];
$to=$_GET['to'];
$data="";
$q1="select * from purches p,product k where p.pid=k.pid and date(p.created_timestamp) between '".$fm."' and '".$to."'";
 $r=mysqli_query($conn,$q1) or die(mysqli_error($conn));
 $data .="<div style='text-align: center;'>
<h1>S K Enterprise</h1>
<h2>Purches Report</h2>
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
            <th style='padding-left: 20px; padding-right: 20px;'>Selling Price</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Purches Price</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Date</th>
        </tr>
    </thead>
    <tbody>";
 if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {  
       $data .= "<tr>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['product_name']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['company_name']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['quantity']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['selling_price']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['purches_price']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['created_timestamp']."</td>
           </tr> <hr>";
    }
}
$data .="</tbody>
</table>
</div>";

$mpdf->WriteHTML($data);
$mpdf->Output();
?>