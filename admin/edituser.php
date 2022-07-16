<?php
require "../connection.php";
$uid=$_POST['uid'];
$fname=$_POST['name'];
$mob=$_POST['mob'];
$addr=$_POST['addr'];
$role=$_POST['role'];
$status;
if(isset($_POST['status']))
{
    $status=$_POST['status'];
}
else
{
    $status='active';
}

$q="update user set full_name='".$fname."',mobile_no='".$mob."',address='".$addr."',status='".$status."',role='".$role."',updated_timestamp=now() where uid=$uid";
$r=mysqli_query($conn,$q) or die("Query failed".mysqli_error($conn));
if($r)
{
    echo "Successfully Update";
}
else
{
    echo "Failed:  ".mysqli_error($conn);
}
?>