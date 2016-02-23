<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$ExistId        = trim($_REQUEST['ExistId']);
$Title          = trim($_REQUEST['Title']);
$Person         = trim($_REQUEST['Person']);
$Address1       = trim($_REQUEST['Address1']);
$Address2       = trim($_REQUEST['Address2']);
$SelCountry     = trim($_REQUEST['SelCountry']);
$SelState       = trim($_REQUEST['SelState']);
$SelCity        = trim($_REQUEST['SelCity']);
$BArea          = trim($_REQUEST['BArea']);
$BPincode       = trim($_REQUEST['BPincode']);
$LandLine       = trim($_REQUEST['LandLine']);
$Email          = trim($_REQUEST['Email']);
$Fax            = trim($_REQUEST['Fax']);
$UId            = trim($_SESSION['LID']);
$Action         = trim($_REQUEST['action']);

if($Action=='1')
{
if($ExistId=='')
{
db_query("INSERT INTO ".TABLE_CONTACT." SET CI_UserFk='".$UId."',CI_Title='".$Title."',CI_Address='".$Address1."',CI_Address2='".$Address2."',CI_Country='".$SelCountry."',CI_State='".$SelState."',CI_City='".$SelCity."',CI_Area='".$BArea."',CI_Pincode='".$BPincode."',CI_Phone='".$LandLine."',CI_Email='".$Email."',CI_Person='".$Person."',CI_Fax='".$Fax."',CI_CreatedOn=Now(),CI_ModifiedOn=Now() ");
$InsertId = db_insert_id();
echo 'Added Successfullly';
}
else
{
db_query("UPDATE ".TABLE_CONTACT." SET CI_UserFk='".$UId."',CI_Title='".$Title."',CI_Address='".$Address1."',CI_Address2='".$Address2."',CI_Country='".$SelCountry."',CI_State='".$SelState."',CI_City='".$SelCity."',CI_Area='".$BArea."',CI_Pincode='".$BPincode."',CI_Phone='".$LandLine."',CI_Email='".$Email."',CI_ModifiedOn=Now(),CI_Person='".$Person."',CI_Fax='".$Fax."' WHERE CI_Id='".$ExistId."'");
$InsertId = $ExistId;
echo 'Updated Successfullly';
}


}
if($Action=='2')
{
db_query("DELETE FROM  ".TABLE_CONTACT." WHERE CI_Id='".$ExistId."'");
echo 'Deleted Successfullly';
}

if($Action=='3')
{
$Sql = db_query("SELECT CI_Id,CI_Title,CI_Address,CI_Address2,CI_Country,CI_State,CI_City,CI_Area,CI_Pincode,CI_Phone,CI_Email,CI_Person,CI_Fax FROM ".TABLE_CONTACT." WHERE CI_Id='".$ExistId."'");
list($CI_Id,$CI_Title,$CI_Address,$CI_Address2,$CI_Country,$CI_State,$CI_City,$CI_Area,$CI_Pincode,$CI_Phone,$CI_Email,$CI_Person,$CI_Fax) = db_fetch_array($Sql);
echo $CI_Id.'*##*'.$CI_Title.'*##*'.$CI_Address.'*##*'.$CI_Address2.'*##*'.$CI_Country.'*##*';?>

<select name="CISelState" id="CISelState" onchange="return OnclickStatee(this.value,'CISelCountry','CISelState','CISelCity','CIBArea','CIBPincode');"  class="inp-text" >
<option value="">--Select State--</option>
<?php
$SelectState=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='".$CI_Country."' Order by Id asc");
while(list($MSId,$MSName)=db_fetch_array($SelectState))
{?>
<option  value="<?php echo $MSId; ?>" <?php if($CI_State==$MSId){?>selected=selected<?php }?> ><?php echo $MSName; ?></option><?php 
}?>
</select>'*##*'
<select name="CISelCity" id="CISelCity"  class="inp-text" onchange="return OnclickCityy(this.value,'CISelCountry','CISelState','CISelCity','CIBArea','CIBPincode');">
<option value="">--Select City--</option>
<?php $SelectCity=db_query("Select Id,Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$CI_Country."' AND A_State='".$CI_State."' Order by Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectCity))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($CI_City==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select>'*##*'<select name="CIBArea" id="CIBArea"  class="inp-text" onchange="return OnclickCityy(this.value,'CISelCountry','CISelState','CISelCity','CIBArea','CIBPincode');">
<option value="">--Select Area--</option>
<?php $SelectArea=db_query("Select AM_Id,AM_Area From ".TABLE_AREAMASTER." WHERE AM_Status=1 AND AM_Country='".$CI_Country."' AND AM_State='".$CI_State."' AND AM_City='".$CI_City."' Order by AM_Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectArea))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($CI_Area==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select>'*##*'<select name="CIBPincode" id="CIBPincode"  class="inp-text" >
<option value="">--Select Pincode--</option>
<?php $SelectPin=db_query("Select PM_Id,PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status=1 AND PM_Country='".$CI_Country."' AND PM_State='".$CI_State."' AND PM_City='".$CI_City."' AND PM_Area='".$CI_Area."' Order by PM_Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectPin))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($CI_Pincode==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select>
<?php
echo '*##*'.$CI_Phone.'*##*'.$CI_Email.'*##*'.$CI_Person.'*##*'.$CI_Fax.'*##*';
}

$sqltot="SELECT CI_Id,CI_Title FROM ".TABLE_CONTACT." WHERE  CI_UserFk='".$UId."' order by  CI_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=2;
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
<td width="10%">S.No.</td>
<td width="80%">Title</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=$i;
while(list($CI_Id,$CI_Title) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40" <?php if($CI_Id == $ExistId || $CI_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="10%"><?php  echo $Pid;?></td>
<td width="80%"><?php echo $CI_Title;?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="ContactEdit(<?php echo $CI_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="ContactDelete(<?php echo $CI_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageContact'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="5" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"   height="25"><td colspan="5"></td></tr>
<?php }?>
</table>
