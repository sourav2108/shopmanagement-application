<?php
require "../connection.php";
$name=$_POST['name'];
$status;
if(isset($_POST['status']))
{
  $status=$_POST['status'];
}
else
{
  $status='active';
}

if($name==null)
{
  $q1="select p.pid,p.product_name,p.company_name,c.category_name,u.full_name,p.status 
  from product p,user u,category c where p.uid=u.uid and p.cid=c.cid and p.status='".$status."' limit 6";
  $res=mysqli_query($conn,$q1) or die("Query failed".mysqli_error($conn));
  $no=mysqli_num_rows($res);
  if($no>0)
  {
      while($ro=mysqli_fetch_assoc($res))
      {
        echo "<tr>
        <th scope='row'>".$ro['pid']."</th>
        <td>".$ro['product_name']."</td>
        <td>".$ro['company_name']."</td>
        <td>".$ro['category_name']."</td>
        <td>".$ro['full_name']."</td>
        <td>".$ro['status']."</td>
        <td><i class='fa-solid fa-pen me-2 text-success' id='pedit' data-bs-toggle='modal'
                data-bs-target='#edituser' data-pid='".$ro['pid']."' style='cursor: pointer;'></i><i
                class='fa-solid fa-trash-can text-danger' id='pdelete' data-pid='".$ro['pid']."' style='cursor: pointer;'></i>
        </td>
        </tr>";
      }
  }
  else
  {
    echo "<th scope='row'>No Record Found</th>";
  }
}
else
{
  $q1="select p.pid,p.product_name,p.company_name,c.category_name,u.full_name,p.status 
  from product p,user u,category c where p.uid=u.uid and p.cid=c.cid and p.product_name like'%".$name."%' and and p.status='".$status."'";
  $res=mysqli_query($conn,$q1) or die("Query failed".mysqli_error($conn));
  $no=mysqli_num_rows($res);
  if($no>0)
  {
      while($ro=mysqli_fetch_assoc($res))
      {
        echo "<tr>
        <th scope='row'>".$ro['pid']."</th>
        <td>".$ro['product_name']."</td>
        <td>".$ro['company_name']."</td>
        <td>".$ro['category_name']."</td>
        <td>".$ro['full_name']."</td>
        <td>".$ro['status']."</td>
        <td><i class='fa-solid fa-pen me-2 text-success' id='pedit' data-bs-toggle='modal'
                data-bs-target='#edituser' data-cid='".$ro['pid']."' style='cursor: pointer;'></i><i
                class='fa-solid fa-trash-can text-danger' id='pdelete' data-cid='".$ro['pid']."' style='cursor: pointer;'></i>
        </td>
        </tr>";
      }
  }
  else
  {
    echo "<th scope='row'>No Record Found</th>";
  }
}
?>