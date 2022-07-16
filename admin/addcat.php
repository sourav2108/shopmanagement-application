<?php
session_start();
if(isset($_SESSION['uid']))
{
    require "../connection.php";
    $name=$_POST['name'];
    $q="insert into category(category_name,uid) values('".$name."','".$_SESSION['uid']."')";
    
    $res=mysqli_query($conn,$q);
    if($res)
    {
        echo "Successfully created";
    }
    else
    {
        echo "Something went worng.".mysqli_error($conn);
    }
}
else
{
    echo "Kindly Login First";
}

?>