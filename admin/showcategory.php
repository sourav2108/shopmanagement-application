<?php
require "../connection.php";
$name=$_POST['name'];

if($name==null)
{
  $q1="select c.cid,c.category_name,u.full_name from category c,user u where c.uid=u.uid limit 5";
  $res=mysqli_query($conn,$q1) or die("Query failed".mysqli_error($conn));
  $no=mysqli_num_rows($res);
  if($no>0)
  {
      while($ro=mysqli_fetch_assoc($res))
      {
        echo "<tr>
        <th scope='row'>".$ro['cid']."</th>
        <td>".$ro['category_name']."</td>
        <td>".$ro['full_name']."</td>
        <td><i class='fa-solid fa-pen me-2 text-success' id='cedit' data-bs-toggle='modal'
                data-bs-target='#edituser' data-cid='".$ro['cid']."' style='cursor: pointer;'></i><i
                class='fa-solid fa-trash-can text-danger' id='delete' data-cid='".$ro['cid']."' style='cursor: pointer;'></i>
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
  $q2="select c.cid,c.category_name,u.full_name from category c,user u where c.uid=u.uid and c.category_name like'%".$name."%' limit 5";
  $r=mysqli_query($conn,$q2) or die("Query failed".mysqli_error($conn));
  $n=mysqli_num_rows($r);
  if($n>0)
  {
      while($row=mysqli_fetch_assoc($r))
      {
        echo "<tr>
        <th scope='row'>".$row['cid']."</th>
        <td>".$row['category_name']."</td>
        <td>".$row['full_name']."</td>
        <td><i class='fa-solid fa-pen me-2 text-success' data-bs-toggle='modal'
                data-bs-target='#edituser' data-cid='".$row['cid']."' style='cursor: pointer;'></i><i
                class='fa-solid fa-trash-can text-danger' data-cid='".$row['cid']."' style='cursor: pointer;'></i>
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