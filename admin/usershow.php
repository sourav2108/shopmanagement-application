<?php
require "../connection.php";
$name=$_POST['name'];
$status=$_POST['st'];
$v="";
if($name==null)
{
  $q1="select * from user where status='".$status."' limit 5";
  $res=mysqli_query($conn,$q1) or die("Query failed".mysqli_error($conn));
  $no=mysqli_num_rows($res);
  if($no>0)
  {
    
      while($ro=mysqli_fetch_assoc($res))
      {
        $ani;
        if($ro['role']=='admin')
        {
          $ani=1;
        }
        else
        {
          $ani=0;
        }
        $v.= "<tr>
        <th scope='row'>".ucfirst($ro['full_name'])."</th>
        <td>".$ro['mobile_no']."</td>
        <td>".$ro['address']."</td>
        <td>".$ro['user_name']."</td>
        <td>".$ro['role']."</td>
        <td>".$ro['status']."</td>
        <td><i class='fa-solid fa-pen me-2 text-success' id='uedit' data-bs-toggle='modal'
                data-bs-target='#edituser' data-uid='".$ro['uid']."' style='cursor: pointer;'></i>";
                if($ani==0)
                {
                  $v.="<i class='fa-solid fa-trash-can text-danger' id='udelete' data-uid='".$ro['uid']."' style='cursor: pointer;'></i>";
                }                
        $v.="</td>
        </tr>";
      }
      echo $v;
  }
  else
  {
    echo "<th scope='row'>No Record Found</th>";
  }
}
else
{
  $q1="select * from user where full_name like'%".$name."%' and status='".$status."' limit 5";
  $res=mysqli_query($conn,$q1) or die("Query failed".mysqli_error($conn));
  $no=mysqli_num_rows($res);
  if($no>0)
  {
      while($ro=mysqli_fetch_assoc($res))
      {
        $ani;
        if($ro['role']=='admin')
        {
          $ani=1;
        }
        else
        {
          $ani=0;
        }
        $v.= "<tr>
        <th scope='row'>".ucfirst($ro['full_name'])."</th>
        <td>".$ro['mobile_no']."</td>
        <td>".$ro['address']."</td>
        <td>".$ro['user_name']."</td>
        <td>".$ro['role']."</td>
        <td>".$ro['status']."</td>
        <td><i class='fa-solid fa-pen me-2 text-success' id='uedit' data-bs-toggle='modal'
                data-bs-target='#edituser' data-uid='".$ro['uid']."' style='cursor: pointer;'></i>";
                if($ani==0)
                {
                  $v.="<i class='fa-solid fa-trash-can text-danger' id='udelete' data-uid='".$ro['uid']."' style='cursor: pointer;'></i>";
                }                
        $v.="</td>
        </tr>";
      }
      echo $v;
  }
  else
  {
    echo "<th scope='row'>No Record Found</th>";
  }
}
?>