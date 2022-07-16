<?php
session_start();
require "connection.php";
$name=$_POST['uname'];
$pass=$_POST['pass'];
$status='active';

$a=$conn->prepare("select * from user where user_name=? and status=?");
$a->bind_param("ss",$name,$status);
$a->execute();
$r=$a->get_result();
if($r->num_rows>0)
{
    $ans=$r->fetch_assoc();

    if(password_verify($pass,$ans['password']))
    {
        $_SESSION['uid']=$ans['uid'];
        $_SESSION['role']=$ans['role'];
    
        session_regenerate_id(false);
        echo "1";
    }
    else
    {
        echo 0;
    }
}
else
{
    echo "0";
}
?>