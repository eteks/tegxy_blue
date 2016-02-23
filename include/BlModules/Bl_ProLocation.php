<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$Country         = trim($_REQUEST['Country']);
$State           = trim($_REQUEST['State']);
$City            = trim($_REQUEST['City']);
$Area            = trim($_REQUEST['Area']);
$Pincode         = trim($_REQUEST['Pincode']);
$ExistId         = trim($_REQUEST['ExistId']);
$LExistId         = trim($_REQUEST['LExistId']);

$UId             = trim($_SESSION['LID']);
$Action          = trim($_REQUEST['action']);

if($ExistId=='')
$ExistId = 'Pro1';
else
$ExistId = $ExistId;


if($Action=='1')
{
if($LExistId=='')
{
$Check = db_query("SELECT LN_Country FROM ".TABLE_LOCATION." WHERE LN_UserFk='".$UId."' AND LN_PSFk='".$ExistId."' AND LN_Country='".$Country."' AND LN_State='".$State."' AND LN_City='".$City."' AND LN_Area='".$Area."' AND LN_Pincode='".$Pincode."'");	
if(db_num_rows($Check)==0)
{	
db_query("INSERT INTO ".TABLE_LOCATION." SET LN_UserFk='".$UId."',LN_PSFk='".$ExistId."',LN_Country='".$Country."',LN_State='".$State."',LN_City='".$City."',LN_Area='".$Area."',LN_Pincode='".$Pincode."',LN_CreatedOn=Now(),LN_ModifiedOn=Now() ");
$InsertId = db_insert_id();
echo 'Added Successfullly';
}
else
echo 'Already Exist';
}
else
{
db_query("UPDATE ".TABLE_LOCATION." SET LN_Country='".$Country."',LN_State='".$State."',LN_City='".$City."',LN_Area='".$Area."',LN_Pincode='".$Pincode."',LN_ModifiedOn=Now() WHERE LN_Id='".$LExistId."'");
$InsertId = $LExistId;
echo 'Updated Successfullly';
}


}
if($Action=='2')
{
	
db_query("DELETE FROM  ".TABLE_LOCATION." WHERE LN_Id='".$LExistId."'");
echo 'Deleted Successfullly';
}

if($Action=='3')
{
$Sql = db_query("SELECT LN_Id,LN_PSFk,LN_Country,LN_State,LN_City,LN_Area,LN_Pincode FROM ".TABLE_LOCATION." WHERE LN_Id='".$LExistId."'");
list($LN_Id,$LN_PSFk,$LN_Country,$LN_State,$LN_City,$LN_Area,$LN_Pincode) = db_fetch_array($Sql);
echo $LN_Id.'*##*'.CountryName($LN_Country).'*##*'.StateName($LN_State).StringLeftArrow(CityName($LN_City),' >> ',3).StringLeftArrow(AreaName($LN_Area),' >> ',3).StringLeftArrow(PincodeName($LN_Pincode),' >> ',3).'*##*'.$LN_Country.'*##*'.$LN_State.StringLeftArrow($LN_City,' >> ',3).StringLeftArrow($LN_Area,' >> ',3).StringLeftArrow($LN_Pincode,' >> ',3).'*##*';
}

$sqltot="SELECT LN_Id,LN_PSFk,LN_Country,LN_State,LN_City,LN_Area,LN_Pincode FROM ".TABLE_LOCATION." WHERE  LN_UserFk='".$UId."' AND LN_PSFk='".$ExistId."' order by  LN_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
$noofpages=$totalrecord/$pagesize;

if (!isset($_REQUEST['startdata']) || trim($_REQUEST['startdata'])=='' || trim($_REQUEST['startdata'])=='0')
$startdata=0;
else
$startdata=$_REQUEST['startdata'];

if(isset($_REQUEST['Count']) && $_REQUEST['Count']==1 && $startdata > 0){
	$startdata = $_REQUEST['startdata']-$pagesize;
	$i=$_REQUEST["startdata"]-($pagesize-1); 
}
else if(isset($_REQUEST['Count']) && $_REQUEST['Count']==1 && $startdata==0){
	$startdata = $_REQUEST['startdata'];
	$i=1;
}

else if($_REQUEST["startdata"]=="0")
	$i=1;	
elseif($_REQUEST["startdata"]!="0")
	$i=$_REQUEST["startdata"]+1; 
else
	$i=1; 	
	
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);?>
######<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="5%">S.No.</td>
<td width="20%">Country</td>
<td width="20%">State</td>
<td width="20%">City</td>
<td width="25%">Area</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="6" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=$i;
while(list($LN_Id,$LN_PSFk,$LN_Country,$LN_State,$LN_City,$LN_Area,$LN_Pincode) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40" <?php if($LN_Id == $LExistId || $LN_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="5%"><?php  echo $Pid;?></td>
<td width="20%"><?php  echo CountryName($LN_Country);?></td>
<td width="20%"><?php  echo StateName($LN_State);?></td>
<td width="20%"><?php  echo CityName($LN_City);?></td>
<td width="25%"><?php  echo AreaName($LN_Area).StringLeftArrow(PincodeName($LN_Pincode),' - ',3);?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="ProLocationEdit(<?php echo $LN_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="ProLocationDelete(<?php echo $LN_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="6" class="gridlinebgcolor"></td></tr>
<tr height="25"><td colspan="6"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageProLocation'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="6" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="6" class="gridlinebgcolor"></td></tr>
<tr   height="25"><td colspan="6"></td></tr>
<?php }?>
</table>
