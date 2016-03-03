<?php
include('db.php');

if($_POST)
{
$com=$_POST['com_search'];
?>
	
<?php  

$sql_res=mysql_query("select * from tbl_registration where RGT_Status=1 AND RGT_Type=2 AND RGT_CompName like '%$com%' order by RGT_CompName LIMIT 5");

while($row=mysql_fetch_array($sql_res))
{
$RGT_CompName=$row['RGT_CompName'];

//$b_username='<strong>'.$q.'</strong>';

//$final_username = str_ireplace($q, $b_username, $RGT_CompName);
?>

<div class="com_show" align="left">
<span class="name"><?php echo $RGT_CompName; ?></span>&nbsp;
</div>   
    
<?php }  } ?>
