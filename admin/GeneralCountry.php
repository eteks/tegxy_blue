<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');
if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
include("include/BlModules/Bl_GeneralCountry.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$SelectCountry=db_query("Select * from ".TABLE_GENERALCOUNTRYMASTER." WHERE Id='".$_REQUEST['id']."'");
$Fetch=db_fetch_array($SelectCountry);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']==''){	$_REQUEST['startdata']=0;}
if($_REQUEST['startdata']==-1){	$_REQUEST['startdata']=0;} ?>
<script type="text/javascript" src="js/GeneralCountry.js"></script>
<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Country Master</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="GeneralCountryForm" enctype="multipart/form-data" name="GeneralCountryForm" action="index.php" onsubmit="return ValidateCountry();" >
<input type="hidden" value="<?php echo $Fetch['Id']; ?>" id="ExistId" name="ExistId" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;
<?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Country Name Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; }
?></span></td></tr>
<tr>
<td width="30%" height="24" align="right"><span class="feildstxt">*Country Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="68%" height="24">
<?php $autoCode = getMaxId(TABLE_GENERALCOUNTRYMASTER, 'Id') + 1;
$autoCode = 'GCTY'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['Country_Code'] == '')
$autoCode = 'GCTY'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') 
$autoCode = $Fetch['Country_Code'];

?><input type="text" name="Country_Code" id="Country_Code" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/></td>
</tr>
<tr>
<td width="30%" height="24" align="right"><span class="feildstxt">*Country ISO Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="68%" height="24"><input type="text" autocomplete="off"  name="ISOCode" id="ISOCode" value="<?php echo $Fetch['Country_ISO'] ?>" <?php if($_REQUEST['action']=='view'){ ?> readonly="readonly" <?php } ?> class="input" />&nbsp;&nbsp;<span id="validateshow"><span id="Req2" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="30%" height="24" align="right"><span class="feildstxt">*Country Name </span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="68%" height="24"><input type="text" autocomplete="off"  name="CountryName" id="CountryName" value="<?php echo $Fetch['Country_Name'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="readonly" <?php } ?> class="input" />&nbsp;&nbsp;<span id="validateshow"><span id="Req1" class="feildstxt"></span></span></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Description</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><textarea autocomplete="off"  name="Description" id="Description" <?php if($_REQUEST['action']=='view'){ ?> readonly="" <?php } ?> class="input" style="width:400px;height:70px;"><?php echo $Fetch['Description'] ?></textarea>
</td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  /></td>
</tr>
<tr>
<td height="30" colspan="3" align="center">
<?php
$submitName = 'SubCountry';
$fileName   = 'GeneralCountry';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="GeneralCountryForm" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" />
</td>
</tr>
</table>
</form>
</td>
</tr>
<script type="text/javascript" language="javascript">
var cursorpointer=document.getElementById('CountryName').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<Td align="right"><span class="feildstxt">Country :</span><span id="FilterFieldList"><input type="hidden" name="SearchFilterFieldList" id="SearchFilterFieldList" value="Country" /></span><span id="FilterField"><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php $_REQUEST['SearchFilterField'] = (isset($_REQUEST['SearchFilterField']) ? $_REQUEST['SearchFilterField'] : ''); echo $_REQUEST['SearchFilterField']; ?>" class="input"/></span><span>&nbsp;&nbsp;<input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_GeneralCountry');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div  id="DetailList">
<?php $_REQUEST['optid'] = (isset($_REQUEST['optid']) ? $_REQUEST['optid'] : '');
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.Id, a.Country_ISO, a.Country_Name, a.Status From ".TABLE_GENERALCOUNTRYMASTER." a";
$orderBy = ' a.Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.Country_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'General Country Master Details';
$colHead  = array("Sl.No.", "Country ISO", "Country Name", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>