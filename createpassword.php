<?php
require_once 'connection.php';
$pass=password_hash($_POST['pass'],PASSWORD_BCRYPT);
$uname=$_POST['uname'];
$status='active';
$q1="select * from user where user_name='".$uname."' and status='".$status."'";
$q2="update user set password='".$pass."' where user_name='".$uname."'";
$r=mysqli_query($conn,$q1);
if(mysqli_num_rows($r)==1)
{
    if(mysqli_query($conn,$q2))
   {
       echo 1;
   }   
   else{
       echo mysqli_error($conn);
   }  
}
else
{
    echo 2;
}

