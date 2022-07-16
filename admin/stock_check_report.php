<?php
require_once '../vendor/autoload.php';
require "../connection.php";

$mpdf = new \Mpdf\Mpdf();

$data="";
$q1="select a.product_name,a.company_name,ifnull(b.inn,0) as inn,ifnull(c.outs,0) as outs,a.avl_quantity from (select s.pid,p.product_name,p.company_name,s.avl_quantity from stock s,product p where s.pid=p.pid) a LEFT JOIN 
(select pid,sum(quantity) as inn from purches where extract(YEAR from created_timestamp)=extract(YEAR from sysdate()) group by pid) b on a.pid=b.pid
LEFT JOIN (select pid,sum(quantity) as outs from sales where extract(YEAR from created_timestamp)=extract(YEAR from sysdate()) group by pid) c on a.pid=c.pid";
$r=mysqli_query($conn,$q1)  or die(mysqli_error($conn));

 $data .="<div style='text-align: center;'>
<h1>S K Enterprise</h1>
<h2>Stock Report</h2>
<hr>
</div>

<div>
<table style='margin: auto; text-align: center;'>
    <thead>
        <tr>
            <th style='padding-left: 20px; padding-right: 20px;'>Product Name</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Comapany Name</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Stock In</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Stock Out</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Availabel Stock</th>
            <th style='padding-left: 20px; padding-right: 20px;'>Previous Stock</th>
        </tr>
    </thead>
    <tbody>";
 if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {
        $s=(($row['outs']+$row['avl_quantity'])-$row['inn']);
        
       $data .= "<tr>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['product_name']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['company_name']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['inn']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['outs']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>".$row['avl_quantity']."</td>
            <td style='padding-left: 20px; padding-right: 20px;'>$s</td>
           </tr> <hr>";
    
    }
}
else
{
    $data="error";
}
$data .="</tbody>
</table>
</div>";

$mpdf->WriteHTML($data);
$mpdf->Output();
?>