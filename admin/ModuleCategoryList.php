<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");
$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".TABLE_MODULECATEGORYLIST." WHERE ModuleList_pk='".$_REQUEST['id']."' ");
$Fetch=db_fetch_array($Select);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;
?>

<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Module List</td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="ModuleListForm" name="ModuleListForm" action="index.php" onSubmit="return ValidateModuleList();">
<input type="hidden" value="<?php echo $Fetch['ModuleList_pk']; ?>" id="ExistId" name="ExistId" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;
<?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Membership Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; }
?></span></td></tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Module Category Name</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<select name="SelModule" id="SelModule" class="dropdown">
<option value="">--Select--</option>
<?php
$SelectModule=db_query("Select * From ".TABLE_MODULECATEGORY." WHERE ModuleCategory_Status=1"); 
while($FetchModule=db_fetch_array($SelectModule))
{ ?>
<option value="<?php echo $FetchModule['ModuleCategory_pk']; ?>" <?php if($FetchModule['ModuleCategory_pk']==$Fetch['ModuleList_fk']){ ?> selected <?php } ?>><?php echo $FetchModule['ModuleCategory_Name'] ?></option>
<?php } ?>
</select>&nbsp;&nbsp;<span id="validateshow"><span id="Req1" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">* Module List Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<?php
$autoCode = getMaxId(TABLE_MODULECATEGORYLIST, 'ModuleList_pk') + 1;
$autoCode = 'SMD'.$autoCode;
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$Fetch['ModuleList_code'] = (isset($Fetch['ModuleList_code']) ? $Fetch['ModuleList_code'] : '');
if ($_REQUEST['action']=='edit' && $Fetch['ModuleList_code'] == '')
$autoCode = 'SMD'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['ModuleList_code'];
?><input type="text" name="ModuleList_code" id="ModuleList_code" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>&nbsp;&nbsp;<span id="validateshow"><span id="Req2" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">* Module List Name</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><input type="text" autocomplete="off"  name="ModuleList_name" id="ModuleList_name" value="<?php $Fetch['ModuleList_name'] = (isset($Fetch['ModuleList_name']) ? $Fetch['ModuleList_name'] : ''); echo $Fetch['ModuleList_name']; ?>" <?php if($_REQUEST['action']=='view'){ ?> readonly="" <?php } ?> class="input" />&nbsp;&nbsp;<span id="validateshow"><span id="Req3" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Module List Function</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<textarea autocomplete="off" class="input"  name="ModuleList_function" id="ModuleList_function" 
<?php if($_REQUEST['action']=='view'){ ?> readonly="" <?php }?> style="width:250px;height:70px;"><?php $Fetch['ModuleList_function'] = (isset($Fetch['ModuleList_function']) ? $Fetch['ModuleList_function'] : ''); echo stripslashes($Fetch['ModuleList_function']);?></textarea><span id="validateshow"><span id="Req4" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">* Module List Image</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><input type="text" autocomplete="off"  name="ModuleList_image" id="ModuleList_image" value="<?php $Fetch['ModuleList_image'] = (isset($Fetch['ModuleList_image']) ? $Fetch['ModuleList_image'] : ''); echo $Fetch['ModuleList_image'] ?>" <?php if( $_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" />&nbsp;&nbsp;<span id="validateshow"><span id="Req5" class="feildstxt"></span></span></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24">
<input type="checkbox" name="ModuleList_status" id="ModuleList_status" style="width:20px;border:0px;" value="1" class="input" <?php $Fetch['ModuleList_status'] = (isset($Fetch['ModuleList_status']) ? $Fetch['ModuleList_status'] : '');  if($Fetch['ModuleList_status']==1 || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked" <?php } if($_REQUEST['action']=='view'){ ?> disabled <?php } ?> /></td>
</tr>
<tr>
<td height="24" align="right">&nbsp;</td>
<td height="24" align="center">&nbsp;</td>
<td height="30">
<?php
$submitName = 'SubModule';
$fileName   = 'ModuleCategoryList';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="ModuleListForm" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" /></td>
</tr>
</table>
</form></td>
</tr>
<script>
var cursorpointer=document.getElementById('ModuleList_Code').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<td align="right"><span class="feildstxt"> Select Filter Option&nbsp;&nbsp;:&nbsp;&nbsp;<select name="SearchFilterFieldList" id="SearchFilterFieldList" onchange="return onchangeFilterField('Bl_ModuleCategoryList');"><option value="">-- Select Filter --</option><option value="ModuleCategory" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='ModuleCategory'){ echo 'Selected';} ?> >Module Category</option><option value="ModuleCategoryList" <?php if($_REQUEST['SearchFilterFieldList']=='ModuleCategoryList'){ echo 'Selected';} ?>>Module Category List</option></select></span>&nbsp;&nbsp;<span id="FilterFieldList"><?php
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ModuleCategory') 
{ ?>
<select id="SearchFilterField" name="SearchFilterField" class="dropdown">
<option value="" selected="selected">--Select--</option>
<?php
$SelectModule=db_query("Select * From ".TABLE_MODULECATEGORY." WHERE ModuleCategory_Status=1"); 
while($FetchModule=db_fetch_array($SelectModule))
{ ?>
<option value="<?php echo $FetchModule['ModuleCategory_pk']; ?>" <?php if($_REQUEST['SearchFilterField'] == $FetchModule['ModuleCategory_pk']){ ?> selected <?php } ?>><?php echo $FetchModule['ModuleCategory_Name'] ?></option>
<?php } ?>
</select><?php }
else if($_REQUEST['SearchFilterFieldList']=='ModuleCategoryList') { ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" class="input"/><?php }	 
else { ?><input type="hidden" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php } ?></span>&nbsp;&nbsp;<span><input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_ModuleCategoryList');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div id="DetailList">
<?php
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.ModuleList_pk, b.ModuleCategory_Name, a.ModuleList_name, a.ModuleList_status From ".TABLE_MODULECATEGORYLIST." a LEFT JOIN ".TABLE_MODULECATEGORY." b on b.ModuleCategory_pk = a.ModuleList_fk";
$orderBy = ' a.ModuleList_pk ';
if($_REQUEST['SearchFilterFieldList']=='ModuleCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ModuleList_fk ="'.$_REQUEST['SearchFilterField'].'"';
} 
if($_REQUEST['SearchFilterFieldList']=='ModuleCategoryList')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ModuleList_name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Module List Details';
$colHead  = array("Sl.No.", "Module Category Name", "Module Name", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
