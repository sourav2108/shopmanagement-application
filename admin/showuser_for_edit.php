<?php
session_start();
require '../connection.php';
$uid=$_POST['uid'];
$val;
if($uid==$_SESSION['uid'])
{
    $val=1;
}
else
{
    $val=0;
}
$q="select * from user where uid=$uid";
$r=mysqli_query($conn,$q) or die(mysqli_error($conn));
if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {
        $x= "<label for='uid' class='form-label'>Uid</label>
        <input type='text' class='form-control' value='".$row['uid']."'  name='euid' id='euid' disabled>
        <label for='fname' class='form-label'>Full Name</label>
        <input type='text' class='form-control' value='".$row['full_name']."' name='efname' id='efname'>
        <label for='mob' class='form-label'>Mobile No</label>
        <input type='text' class='form-control' value='".$row['mobile_no']."' name='emob' id='emob'>
        <label for='addr class='form-label'>Address</label>
        <input type='text' class='form-control' value='".$row['address']."' name='eaddr' id='eaddr'>";
       
        if($row['role']=='admin')
        {
           $x.="<select class='form-select mt-3' id='erole' >
           <option value='admin' selected>Admin</option>
           <option value='operator'>Operator</option>
           </select>";
        }
        else
        {
            $x.="<select class='form-select mt-3' id='erole'>
            <option value='admin'>Admin</option>
            <option value='operator' selected>Operator</option>
            </select>";
        }
        if($val==0)
        {
            if($row['status']=='active')
            {
                $x.="<select class='form-select mt-3' id='st' >
                <option value='active' selected>Active</option>
                <option value='inactive'>Inactive</option>
                 </select>";
           }
            else
            {
                $x.="<select class='form-select mt-3' id='st'>
                <option value='active'>Active</option>
                <option value='inactive' selected>Inactive</option>
                 </select>";
            }
        }
        echo $x;
        
    }
}
?>