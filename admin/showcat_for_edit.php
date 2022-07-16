<?php
require '../connection.php';
$cid=$_POST['cid'];
$q="select cid,category_name from category where cid=$cid";
$r=mysqli_query($conn,$q);
if(mysqli_num_rows($r)>0)
{
    while($row=mysqli_fetch_assoc($r))
    {
        echo "<form>
        <label for='ceid' class=form-label'>Category Id</label>
        <input type='text' name='ceid' id='ceid' value='".$row['cid']."' class='form-control' disabled>
        <label for='cename' class='form-label'>Category Name</label>
        <input type='text' name='cename' id='cename' value='".$row['category_name']."' class='form-control'>
    </form>";
    }
}
?>