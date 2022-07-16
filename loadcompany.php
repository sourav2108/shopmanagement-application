<?php
require "connection.php";
$pname=$_POST['pname'];
$q="select * from product where product_name like'".$pname."'";
$val="<option value=''>Select Company</option>";
if($pname=="")
{
  echo $val;
}
else{
  $r=mysqli_query($conn,$q);
  if(mysqli_num_rows($r)>0)
  {
      while($row=mysqli_fetch_assoc($r))
      {
          $val.= "<option value='".$row['pid']."'>".$row['company_name']."</option>";
      }
      echo $val;
  }
  else
    {
      $val.= "<option value=''>No Product Found</option>";
      echo $val;
    }
}

?>