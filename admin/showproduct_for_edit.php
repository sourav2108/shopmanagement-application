<?php
require '../connection.php';
$pid=$_POST['pid'];
$q="select * from product where pid=$pid";
$r=mysqli_query($conn,$q) or die(mysqli_error($conn));
if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {
        $x= "<label for='pid' class='form-label'>Product Id</label>
        <input type='text' class='form-control' value='".$row['pid']."'  name='pid' id='epid' disabled>
        <label for='pename' class='form-label'>Product Name</label>
        <input type='text' class='form-control' value='".$row['product_name']."' name='pname' id='epname'>
        <label for='pcename' class='form-label'>Company Name</label>
        <input type='text' class='form-control' value='".$row['company_name']."' name='cname' id='ecname'>";
        if($row['status']=='active')
        {
           $x.="<select class='form-select mt-3' id='estatus' >
           <option value='active' selected>Active</option>
           <option value='inactive'>Inactive</option>
       </select>";
        }
        else
        {
            $x.="<select class='form-select mt-3' id='estatus'>
            <option value='active'>Active</option>
            <option value='inactive' selected>Inactive</option>
        </select>";
        }
        echo $x;
        
    }
}
?>