<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$LID           = $_SESSION['LID'];
$ProTitle      = addslashes($_REQUEST['ProTitle']);
$ExistId       = $_REQUEST['Exist'];
$SProTitle     = addslashes($_REQUEST['SProTitle']);
$SProDesp      = addslashes($_REQUEST['SProDesp']);
$SExistId      = $_REQUEST['SExist'];
$Action        = $_REQUEST['Action'];
$Option        = $_REQUEST['Option'];
$PId           = $_REQUEST['PId'];
$ProEdit       = $_REQUEST['ProEdit'];

if($ExistId=='')
$SessionId     = session_id();
else
$SessionId     = $ExistId;



if($Action==1)
{
if($Option=='1')
{	
if($ExistId=='')
{
$Check = db_query("SELECT PFE_Title FROM ".TABLE_PROFILE." WHERE PFE_CreatedBy='".$LID."' AND PFE_Title='".$ProTitle."'");	
if(db_num_rows($Check)>0)
echo 'Already Exist######';
else
{
db_query("INSERT INTO ".TABLE_PROFILE." SET PFE_Title='".$ProTitle."',PFE_CreatedBy='".$LID."',PFE_ModifiedOn=Now(),PFE_CreatedOn=Now()");
$InsertId = db_insert_id();
db_query("UPDATE ".TABLE_PROFILEDETAILS." SET PDS_Fk='".$InsertId."' WHERE PDS_Fk='".$SessionId."' AND PDS_CreatedBy='".$LID."'");
echo 'Saved Successfullly######';
}
}
else
{
db_query("UPDATE ".TABLE_PROFILE." SET PFE_Title='".$ProTitle."',PFE_ModifiedOn=Now() WHERE PFE_Pk='".$ExistId."'");
echo 'Updated Successfullly######';
}
}
if($Option=='2')
{
db_query("DELETE FROM  ".TABLE_PROFILE." WHERE PFE_Pk='".$PId."'");
db_query("DELETE FROM  ".TABLE_PROFILEDETAILS." WHERE PDS_Fk='".$PId."' AND PDS_CreatedBy='".$LID."'");
echo 'Deleted Successfullly######';
}
$sqltot="SELECT PFE_Pk, PFE_Title FROM ".TABLE_PROFILE." WHERE PFE_CreatedBy='".$LID."' order by  PFE_Pk desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
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
	
$Profile=db_query("SELECT PFE_Pk, PFE_Title FROM ".TABLE_PROFILE." WHERE PFE_CreatedBy='".$LID."' order by  PFE_Pk desc limit $startdata,$pagesize");
$Count = db_num_rows($Profile);?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="10%">S.No.</td>
<td width="70%">Title</td>
<td width="20%">Action</td>
</tr>
<tr><td colspan="3" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=1;
while(list($ProId,$ProTitle) = db_fetch_array($Profile)){
?>
<tr class="gridcenbgcolor" height="25" <?php if($ProId == $ExistId || $ProId == $InsertId) {?>style="font-weight:bold;"<?php }?>>
<td width="10%"><?php echo $Pid ;?></td>
<td width="70%"><?php if(strlen(stripslashes($ProTitle))>25){ echo substr(stripslashes($ProTitle),0,50).'...' ;} else { echo stripslashes($ProTitle);} ?></td>
<td width="20%"><span onclick="ProfileEdit(<?php echo $ProId;?>);" class="handsym" ><img width="16" border="0" height="16" src="images/b_edit.png" title="Edit"></span>&nbsp;<span onclick="ProfileDelete(<?php echo $ProId;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" class="handsym"><img width="16" border="0" height="16" src="images/b_drop.png" title="Delete"></span></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="3" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="3"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageProfile'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="3" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="3" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"   height="25"><td colspan="3"></td></tr>
<?php }?>
</table>

<?php }


if($Action==2)
{
if($Option==1)
{	
if($SExistId=='')
{
$Check = db_query("SELECT PDS_SubTitle, PDS_Desc FROM ".TABLE_PROFILEDETAILS." WHERE PDS_CreatedBy='".$LID."' AND PDS_SubTitle='".$SProTitle."' AND PDS_Desc='".$SProDesp."'");	
if(db_num_rows($Check)>0)
echo 'Already Exist######';
else
{
db_query("INSERT INTO ".TABLE_PROFILEDETAILS." SET PDS_SubTitle='".$SProTitle."',PDS_Desc='".$SProDesp."' ,PDS_Fk='".$SessionId."', PDS_CreatedBy='".$LID."'");
$InsertId = db_insert_id();
echo 'Added Successfullly######';
}
}
else
{
db_query("UPDATE ".TABLE_PROFILEDETAILS." SET PDS_SubTitle='".$SProTitle."',PDS_Desc='".$SProDesp."' WHERE PDS_Pk='".$SExistId."'");
echo 'Updated Successfullly######';
}
}
if($Option==2)
{
db_query("DELETE FROM  ".TABLE_PROFILEDETAILS." WHERE PDS_Pk='".$PId."'");
echo 'Deleted Successfullly######';
}
$sqltot="SELECT PDS_Pk, PDS_SubTitle, PDS_Desc FROM ".TABLE_PROFILEDETAILS." WHERE PDS_CreatedBy='".$LID."' AND PDS_Fk='".$SessionId."' order by  PDS_Pk desc";
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
$SProfile=db_query("SELECT PDS_Pk, PDS_SubTitle, PDS_Desc FROM ".TABLE_PROFILEDETAILS." WHERE PDS_CreatedBy='".$LID."' AND PDS_Fk='".$SessionId."' order by  PDS_Pk desc limit $startdata,$pagesize");
$SCount = db_num_rows($SProfile);
if($SCount>0){?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder" bgcolor="#CCCCCC">
<tr height="35">
<td width="10%">S.No.</td>
<td width="30%">Sub Title</td>
<?php /*?><td width="30%">Description</td>
<?php */?><td width="20%">Action</td>
</tr>
<?php
$SPid=$i;
while(list($SProId,$SProTitle,$SProDesp) = db_fetch_array($SProfile)){
?>
<tr bgcolor="#F6F6F6"  height="25" <?php if($SProId == $SExistId || $SProId == $InsertId
) {?>style="font-weight:bold;"<?php }?>>
<td width="10%"><?php echo $SPid;?></td>
<td width="30%"><?php if($SProTitle!='')echo $SProTitle ; else echo ' - ';?></td>
<?php /*?><td width="30%" style="float:left;"><?php if(strlen(stripslashes($SProDesp))>25){ echo substr(stripslashes($SProDesp),0,50).'...' ;} else { echo stripslashes($SProDesp);} ?></td>
<?php */?><td width="20%"><span onclick="SubProfileEdit(<?php echo $SProId;?>);" class="handsym"><img width="16" border="0" height="16" src="images/b_edit.png" title="Edit"></span>&nbsp;<span onclick="SubProfileDelete(<?php echo $SProId;?>,<?php echo $SCount;?>,<?php echo $startdata;?>);" class="handsym"><img width="16" border="0" height="16" src="images/b_drop.png" title="Delete"></span></td>
</tr>
<?php  $SPid++;}/*else{?>
<tr bgcolor="#F6F6F6"  height="25">
<td colspan="4">No Record Found</td>
</tr>
<?php }*/?>
<tr bgcolor="#CCCCCC"  height="25"><td colspan="4"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageSubProfile'); ?></td></tr>
</table>

<?php }}

if($Option=='3')
{
$Profile=db_query("SELECT PFE_Pk, PFE_Title FROM ".TABLE_PROFILE." WHERE PFE_Pk='".$PId."'");
list($PFE_Pk,$PFE_Title)= db_fetch_array($Profile);
echo '*##*'.$PFE_Pk.'*##*'.stripslashes($PFE_Title).'*##*';
$sqltot="SELECT PDS_Pk, PDS_SubTitle, PDS_Desc FROM ".TABLE_PROFILEDETAILS." WHERE PDS_CreatedBy='".$LID."' AND PDS_Fk='".$PFE_Pk."' order by PDS_Pk desc";
$tot=db_query($sqltot);
$rtot=@db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
$noofpages=$totalrecord/$pagesize;
$startdata=0;
$SProfile=db_query("SELECT PDS_Pk, PDS_SubTitle, PDS_Desc FROM ".TABLE_PROFILEDETAILS." WHERE PDS_CreatedBy='".$LID."' AND PDS_Fk='".$PFE_Pk."' order by PDS_Pk desc");
$SCount = db_num_rows($SProfile);
if($SCount>0){?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder" bgcolor="#CCCCCC">
<tr height="35">
<td width="10%">S.No.</td>
<td width="30%">Sub Title</td>
<?php /*?><td width="30%">Description</td>
<?php */?><td width="20%">Action</td>
</tr>
<?php
$SPid=1;
while(list($SProId,$SProTitle,$SProDesp) = db_fetch_array($SProfile)){
?>
<tr bgcolor="#F6F6F6"  height="25">
<td width="10%"><?php echo $SPid;?></td>
<td width="30%"><?php if($SProTitle!='')echo $SProTitle ; else echo ' - ';?></td>
<?php /*?><td width="30%" style="float:left;"><?php if(strlen(stripslashes($SProDesp))>25){ echo substr(stripslashes($SProDesp),0,50).'...' ;} else { echo stripslashes($SProDesp);} ?></td>
<?php */?><td width="20%"><span class="handsym" onclick="SubProfileEdit(<?php echo $SProId;?>);"><img width="16" border="0" height="16" src="images/b_edit.png" title="Edit"></span>&nbsp;<span class="handsym" onclick="SubProfileDelete(<?php echo $SProId;?>,<?php echo $SCount;?>,<?php echo $startdata;?>);"><img width="16" border="0" height="16" src="images/b_drop.png" title="Delete"></span></td>
</tr>
<?php  $SPid++;}/*else{?>
<tr bgcolor="#F6F6F6"  height="25">
<td colspan="4">No Record Found</td>
</tr>
<?php }*/?>
<tr bgcolor="#CCCCCC"  height="25"><td colspan="4"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageSubProfile'); ?></td></tr>
</table>
<?php }
}

if($Option=='33')
{
$SProfile=db_query("SELECT PDS_Pk, PDS_SubTitle, PDS_Desc FROM ".TABLE_PROFILEDETAILS." WHERE  PDS_Pk='".$PId."'");
list($PDS_Pk,$PDS_SubTitle,$PDS_Desc)= db_fetch_array($SProfile);
echo '*##*'.$PDS_Pk.'*##*'.stripslashes($PDS_SubTitle).'*##*'.stripslashes($PDS_Desc);
}

if($Option=='4')
db_query("DELETE FROM ".TABLE_PROFILEDETAILS." WHERE PDS_CreatedBy='".$LID."'");

?>