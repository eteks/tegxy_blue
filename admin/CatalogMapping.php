<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

$Select=db_query("Select * from ".TABLE_PRODUCTSPECIFICATION." WHERE ProdSpec_Id='".$_REQUEST['id']."' ");
$Fetch=db_fetch_array($Select);

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
<td align="left" valign="top" class="title">Product Specification</td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="ProdSpecForm" name="ProdSpecForm" action="index.php"  onSubmit="return ValidateProdSpecForm();">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;
<?php 
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; }
?></span></td></tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Product Specification Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<?php
$autoCode = getMaxId(TABLE_PRODUCTSPECIFICATION, 'ProdSpec_Id') + 1;
$autoCode = 'PDS'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['ProdSpec_Code'] == '')
$autoCode = 'PDS'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['ProdSpec_Code'];
?>
<input type="text" name="PDScode" id="PDScode" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>
</td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Product Specification</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24" class="feildstxt"><input type="text" autocomplete="off" maxlength="20" name="PDSName" id="PDSName" value="<?php echo $Fetch['ProdSpecification']; ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input"/>
</td>
<input type="hidden" value="<?php echo $Fetch['ProdSpec_Id']; ?>" id="ExistId" name="ExistId" />
<input type="hidden" value="<?php echo $Fetch['ProdStatus']; ?>" id="Status" name="Status" />
</tr>

<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['ProdStatus']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  /></td>
</tr>
<tr>
<td height="30" colspan="3" align="center">
<?php
$submitName = 'ProdSpec';
$fileName   = 'ProductSpecification';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="ProdSpecForm" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" />
</td>
</tr>
</table>
</form></td>
</tr>

<script>
var cursorpointer=document.getElementById('PDScode').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<Td align="right"><span class="feildstxt">Product Specification :</span><span id="FilterFieldList"><input type="hidden" name="SearchFilterFieldList" id="SearchFilterFieldList" value="PDSName" /></span><span id="FilterField"><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField']; ?>" class="input" /></span><span>&nbsp;&nbsp;<input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onClick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_ProductSpecification');"/></span></td>
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
$all_Sql = "Select DISTINCT a.ProdSpec_Id, a.ProdSpec_Code, a.ProdSpecification, a.ProdStatus From ".TABLE_PRODUCTSPECIFICATION." a ";
$orderBy = ' a.ProdSpec_Id ';

if($_REQUEST['SearchFilterFieldList']=='PDSName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' Where a.ProdSpecification like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if($WhereCont=='')
$WhereCont = ' where 1';

$gridHead = 'Product Specification Details';
$colHead  = array("Sl.No.", "Product Specification Code", "Product Specification", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
