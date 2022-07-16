<?php
require "../connection.php";
$fname=$_POST['fname'];
$mob=$_POST['mob'];
$addr=$_POST['addr'];
$uname=$_POST['uname'];
$role=$_POST['role'];

$q="insert into user(full_name,mobile_no,address,user_name,role) values('".$fname."','".$mob."','".$addr."','".$uname."','".$role."')";
$r=mysqli_query($conn,$q);
if($r)
{
    echo "Successfully Save";
}
else
{
    echo "Failed:  ".mysqli_error($conn);
}
?>